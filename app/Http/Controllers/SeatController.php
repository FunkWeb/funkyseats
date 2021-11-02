<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Room;
use App\Models\SeatType;

class SeatController extends Controller
{
    //
    public function index($id)
    {
        return view('pages.seats', ['seats' => Seat::where('room_id', $id)->get()]);
    }

    public function edit($id)
    {
        return view('pages.admin.edit_seats', ['room' => Room::where('id', $id)->with('seat')->get(), 'types' => SeatType::all()]);
    }

    public function save($id, Request $request)
    {
        $seat = Seat::find($id);

        $seat->seat_number = $request->seat_number;

        $seat->save();

        return back();
    }

    public function delete($id)
    {
        Seat::destroy($id);

        return back();
    }
}
