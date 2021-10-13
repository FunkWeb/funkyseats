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
        $testing =  Room::withCount(['seat' => function ($q) {
            $q
                ->whereDoesntHave("booking", function ($query) {
                    $query
                        ->where('from',  '<=', '2020-06-01 00:00:00')
                        ->where('to',  '>=', date("Y-m-d h:i:s"));
                });
        }]);

        dd($testing);


        return View('pages/home', ['rooms' => Room::withCount(['seat' => function ($q) {
            $q
                ->where('from',  '<=', date("Y-m-d h:i:s"))
                ->where('to',  '>=', date("Y-m-d h:i:s"));
        }])]);
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
