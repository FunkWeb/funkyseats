<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;

class SeatController extends Controller
{
    //
    public function index($id)
    {
        return view('pages.seat', ['seats' => Seat::where('room_id', $id)->get()]);
    }
}
