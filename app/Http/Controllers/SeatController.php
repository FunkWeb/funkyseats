<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Room;

class SeatController extends Controller
{
    //
    public function index($id)
    {
        return view('pages.seats', ['seats' => Seat::where('room_id', $id)->get()]);
    }

    public function edit($id)
    {
        return view('pages.admin.edit_seats', ['room' => Room::where('id', $id)->with('seat')->get()]);
    }
}
