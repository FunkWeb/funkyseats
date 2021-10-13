<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    //

    public function index()
    {
        return View('pages/home', ['rooms' => Room::all()]);
    }

    public function show($id)
    {
        return View(
            'pages/seats',
            ['room' => Room::where('id', $id)
                ->with(['seat' => function ($query) {
                    $query->orderByRaw('CHAR_LENGTH(seat_number)');
                    $query->orderBy('seat_number', 'asc');
                }])
                ->get()]
        );
    }
}
