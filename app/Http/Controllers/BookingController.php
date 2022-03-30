<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Seat;
use App\Rules\AlreadyBookedRule;
use App\Rules\SeatAlreadyTakenRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingController extends Controller
{
    use SoftDeletes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentAndFuture = Booking::where('user_id', auth()->user()->id)->where('from', '>', now()->startOfDay())->with('seat.room')->orderBy('from', 'desc')->get();
        $past = Booking::where('user_id', auth()->user()->id)->where('from', '<', now()->startOfDay())->with('seat.room')->orderBy('from', 'desc')->get();
        return view('pages/mybookings', [
            'bookings' => $currentAndFuture,
            'bookings_old' => $past,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * * @param  \Illuminate\Http\Request  $request * @return \Illuminate\Http\Response */
    public function store($seat_id, Request $request)
    {
        //Hours to book the seats is based on radio button values
        //0 = 8->12
        //1 = 12->16
        //2 = 8->16
        $time_from = BookingController::bookingStartTime($request->book_time, $request->date_picker);
        $time_to = BookingController::bookingEndTime($request->book_time, $request->date_picker);

        $request->merge(['user_id' => auth()->user()->id,]);
        $request->merge(['seat_id' => $seat_id]);
        $request->validate([
            'date_picker' => ['after_or_equal:' . Carbon::today()],
            'user_id' => [new AlreadyBookedRule($time_from, $time_to)],
            'seat_id' => [new SeatAlreadyTakenRule($time_from, $time_to)]
        ]);

        Booking::create([
            'from' => $time_from,
            'to' => $time_to,
            'user_id' => $request->user_id,
            'seat_id' => $request->seat_id,
            'approved' => true,
        ]);

        return back()->with('success', 'You booked the seat successfully');
    }
    public function randomSeat($room_id, Request $request)
    {
        //Hours to book the seats is based on radio button values
        //0 = 8->12
        //1 = 12->16
        //2 = 8->16
        $time_from = BookingController::bookingStartTime($request->book_time, $request->date_picker);
        $time_to = BookingController::bookingEndTime($request->book_time, $request->date_picker);

        $request->merge(['user_id' => auth()->user()->id,]);
        $request->validate([
            'date_picker' => ['after_or_equal:' . Carbon::today()],
            'user_id' => [new AlreadyBookedRule($time_from, $time_to)],
        ]);

        $free_seat = Seat::where('room_id', $room_id)
            ->whereDoesntHave("booking", function ($query) use ($time_from, $time_to) {
                $query
                    ->where('from',  '=', $time_from)
                    ->orwhere('to',  '=', $time_to);
            })->get()->first();

        if (!$free_seat) {
            return back()->with('error', 'No free seat in room at chosen time');
        }

        Booking::create([
            'from' => $time_from,
            'to' => $time_to,
            'user_id' => $request->user_id,
            'seat_id' => $free_seat->id,
            'approved' => true,
        ]);

        return back()->with('success', 'You booked the seat successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function delete(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();

        return back()->with('error', 'You unbooked your seat');
    }

    static private function bookingStartTime($selectValue, $date)
    {
        if ($selectValue == 0) {
            return Carbon::createFromDate($date)->addHours(12);
        } else {
            return Carbon::createFromDate($date)->addHours(16);
        }
    }

    static private function bookingEndTime($selectValue, $date)
    {
        if ($selectValue == 0 || $selectValue == 2) {
            return Carbon::createFromDate($date)->addHours(8);
        } else {
            return Carbon::createFromDate($date)->addHours(12);
        }
    }
}
