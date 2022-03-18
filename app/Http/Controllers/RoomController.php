<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomController extends Controller
{
    //
    use SoftDeletes;

    public function index()
    {
        return View('pages/home', ['rooms' => Room::all()]);
    }

    public function edit()
    {
        return View('pages/admin/edit_rooms', ['rooms' => Room::all()]);
    }

    public function delete($id)
    {
        Room::destroy($id);
        return back()->with('success', 'Rommet ble slettet');
    }

    public function save($id, Request $request)
    {
        $room = Room::find($id);
        $room->name = $request->name;

        $room->save();

        return back()->with('success', 'Rommet ble oppdatert');
    }

    public function index_withCountSeats()
    {
        return view('pages/home', ['rooms' => Room::withCount(['seat' => function ($q) {
            $q
                ->whereDoesntHave("booking", function ($query) {
                    $query
                        ->where('from',  '<=', Carbon::now('Europe/Oslo'))
                        ->where('to',  '>=', Carbon::now('Europe/Oslo'));
                });
        }])->get()]);
    }

    public function show($id, $datetime = null)
    {
        $date_time = Carbon::createFromDate($datetime)->toDateString();
        $time_from = Carbon::createFromDate($date_time)->addHours(8);
        $time_to = Carbon::createFromDate($date_time)->addHours(16);


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
                }, 'seat.booking' => function ($query) use ($time_from, $time_to) {
                    $query
                        ->whereBetween('from', [$time_from, $time_to])
                        ->orWhereBetween('to', [$time_from, $time_to])
                        ->orderBy('from');
                    $query->with('user');
                }])
                ->get(), 'date_selected' => $date_time]
        );
    }

    public function show_display($id)
    {
        return View(
            'pages/display_screen',
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
                        ->where('from', '>=', Carbon::today())
                        ->where('to', '<=', Carbon::today()->addDay());
                    $query->with('user');
                }])
                ->get()]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],

        ]);
        $room = new Room;
        $room->name = $request->name;

        $room->save();
        return back()->with('success', 'Rommet ble lagret');
    }
}
