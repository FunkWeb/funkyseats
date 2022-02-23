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

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/myBookings', ['bookings' => Booking::where('user_id', auth()->user()->id)->with('seat.room')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if ($request->book_time == 0 || $request->book_time == 2) {
            $time_from = Carbon::createFromDate($request->date_picker)->addHours(8);
        } else {
            $time_from = Carbon::createFromDate($request->date_picker)->addHours(12);
        }
        if ($request->book_time == 0) {
            $time_to = Carbon::createFromDate($request->date_picker)->addHours(12);
        } else {
            $time_to = Carbon::createFromDate($request->date_picker)->addHours(16);
        }
        $request->merge(['user_id' => auth()->user()->id,]);
        $request->merge(['seat_id' => $seat_id]);
        $request->validate([
            'date_picker' => ['after_or_equal:' . Carbon::today()],
            'user_id' => [new AlreadyBookedRule($time_from, $time_to)],
            'seat_id' => [new SeatAlreadyTakenRule($time_from, $time_to)]
        ]);

        $booking = new Booking;

        $booking->from = $time_from;
        $booking->to = $time_to;
        $booking->seat_id = $seat_id;
        $booking->user_id = $request->user_id;
        $booking->approved = True;

        $booking->save();

        return back()->with('success', 'You booked the seat successfully');
    }
    public function randomSeat($room_id, Request $request)
    {
        //Hours to book the seats is based on radio button values
        //0 = 8->12
        //1 = 12->16
        //2 = 8->16
        if ($request->book_time == 0 || $request->book_time == 2) {
            $time_from = Carbon::createFromDate($request->date_picker)->addHours(8);
        } else {
            $time_from = Carbon::createFromDate($request->date_picker)->addHours(12);
        }
        if ($request->book_time == 0) {
            $time_to = Carbon::createFromDate($request->date_picker)->addHours(12);
        } else {
            $time_to = Carbon::createFromDate($request->date_picker)->addHours(16);
        }
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

        $booking = new Booking;

        $booking->from = $time_from;
        $booking->to = $time_to;
        $booking->user_id = $request->user_id;
        $booking->seat_id = $free_seat->id;
        $booking->approved = True;

        $booking->save();

        return back()->with('success', 'You booked the seat successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //TODO:(are) can only delete your own booking unless you are an admin
        $booking = Booking::find($id);
        if ($booking) {
            if (Auth::user()->id == $booking->user_id || Auth::user()->hasRole('admin')) {
                $booking->delete();
                return back()->with('success', 'You unbooked your seat');
            }
        }
        return back()->with('error', 'Could not delete the booking');
    }
}
