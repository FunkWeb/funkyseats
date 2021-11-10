<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Room;
use App\Models\SeatType;

class SeatController extends Controller
{
    //TODO: (Are) remove the index for seats? We never list all seats, only in the context of belonging to a room
    public function index()
    {
        return view('pages.seats', ['seats' => Seat::all()]);
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

        return back()->with('success', 'You updated the seat successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'seat_number' => ['required', 'max:255'],
            'seat_type' => ['required', 'exists:seat_types,id'],
        ]);
        $seat = new Seat;
        $seat->seat_number = $request->seat_number;
        $seat->seat_type_id = $request->seat_type;
        $seat->room_id = $request->room_id;

        $seat->save();
        return back()->with('success', 'You stored the seat successfully');
    }

    public function delete($id)
    {
        Seat::destroy($id);


        return back()->with('success', 'You deleted the seat successfully');
    }
}
