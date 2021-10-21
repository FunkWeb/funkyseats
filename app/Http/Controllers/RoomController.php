<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Carbon\Carbon;


class RoomController extends Controller
{
    //

    public function index()
    {
        return View('pages/home', ['rooms' => Room::all()]);
    }

    public function index_withCountSeats()
    {
        return view('pages/home', ['rooms' => Room::withCount(['seat' => function ($q) {
            $q
                ->whereDoesntHave("booking", function ($query) {
                    $query
                        ->where('from',  '<=', Carbon::now())
                        ->where('to',  '>=', Carbon::now());
                });
        }])->get()]);
    }

    public function show($id)
    {
        return View(
            'pages/seats',
            ['room' => Room::where('id', $id)
                ->with(['seat' => function ($query) {
                    if (env('DB_CONNECTION') == "mysql") {
                        $query->orderByRaw('CHAR_LENGTH(seat_number)');
                    } else {
                        $query->orderByRaw('LENGTH(seat_number)');
                    }
                    $query->orderBy('seat_number', 'asc');
                }, 'seat.booking' => function ($query) {
                    $query
                        ->where('from', '<=', Carbon::now())
                        ->where('to', '>=', Carbon::now());
                }])
                ->get()]
        );
    }
}
