<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Room;
use App\Models\SeatType;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatController extends Controller
{
    use SoftDeletes;

    public function edit($id)
    {
        return view('pages.admin.edit_seats', ['room' => Room::where('id', $id)->with('seat')->get(), 'types' => SeatType::all()]);
    }

    public function update(Seat $seat, Request $request)
    {
        $request->validate([
            'seat_type' => ['required', 'exists:seat_types,id'],
        ]);

        $seat->update([
            'seat_number' => $request->seat_number,
            'seat_type_id' => $request->seat_type,
        ]);

        return back()->with('success', 'You updated the seat successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'seat_number' => ['required', 'max:255'],
            'seat_type' => ['required', 'exists:seat_types,id'],
            'room_id' => ['exists:rooms,id'],
        ]);

        Seat::create([
            'seat_number' => $request->seat_number,
            'seat_type_id' => $request->seat_type_id,
            'room_id' => $request->room_id,
        ]);

        return back()->with('success', 'You stored the seat successfully');
    }

    public function delete(Seat $seat)
    {
        $seat->delete();

        return back()->with('success', 'You deleted the seat successfully');
    }
}
