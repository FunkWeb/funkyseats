<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingRestriction;
use App\Models\Seat;
use App\Models\SeatRestriction;
use App\Models\Checkin;

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
            'approved' => BookingController::needsApproval($seat_id),
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
            })
            ->whereDoesntHave("seatRestriction", function ($query) {
                $query->where('booking_restriction_id', '>', '0');
            })
            ->get()->first();

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

    static private function needsApproval($seat_id)
    {
        $restriction = SeatRestriction::where('seat_id', $seat_id)->get();
        for ($i = 0; $i < $restriction->count(); $i++) {
            $booking_restriction_id = $restriction[$i]->booking_restriction_id;
            $bookres = BookingRestriction::where('id', $booking_restriction_id)->get();
            $truth = $bookres[0]->needs_approval;
            if ($truth) return true;
        }

        return false;
    }

    public function currentlyBooked()
    {
        $arr = array();

        // $booked = Booking::select('*')->whereRaw('NOW() between `from` and `to`')
        //     ->leftjoin('users', 'users.id', '=', 'bookings.user_id')
        //     ->select('name', 'from', 'to')
        //     ->get();

        $bookins_and_checkins = array();
        $booked = Booking::select('*')
            ->whereRaw('NOW() between `from` and `to`')
            ->leftjoin('users', 'users.id', '=', 'bookings.user_id')
            ->select('name', 'from', 'to', 'seat_id')
            ->get()
            ->toArray();

        $checked_in = Checkin::select('*')
            ->whereNull('checkout_at')
            ->leftjoin('bookings', 'bookings.user_id', '=', 'checkins.user_id')
            ->select('bookings.user_id', 'from', 'to')
            ->whereRaw('`checkins`.`created_at` between `from` and `to`')
            ->leftjoin('users', 'users.id', '=', 'checkins.user_id')
            ->select('name')
            ->get()
            ->toArray();


        for ($i = 0; $i < count($booked); $i++) {
            for ($j = 0; $j < count($checked_in); $j++) {
                if (in_array($booked[$i]['name'], $checked_in[$j])) {
                    $booked[$i]['checked_in'] = true;
                    break;
                } else {
                    $booked[$i]['checked_in'] = false;
                }
            }
            array_push($bookins_and_checkins, $booked[$i]);
        }

        $json_bookins = json_encode($bookins_and_checkins);
        ddd($json_bookins);

        // return $bookins_and_checkins;
        return view('pages.admin.display_screen', ['stats' => $jsonStats]);
    }

    static private function bookingEndTime($selectValue, $date)
    {
        if ($selectValue == 0) {
            return Carbon::createFromDate($date)->addHours(12);
        } else {
            return Carbon::createFromDate($date)->addHours(16);
        }
    }

    static private function bookingStartTime($selectValue, $date)
    {
        if ($selectValue == 0 || $selectValue == 2) {
            return Carbon::createFromDate($date)->addHours(8);
        } else {
            return Carbon::createFromDate($date)->addHours(12);
        }
    }
}
