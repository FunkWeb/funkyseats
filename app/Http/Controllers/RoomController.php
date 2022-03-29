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

    public function delete(Room $room)
    {
        $room->delete();

        return back()->with('success', 'You deleted the room successfully');
    }

    public function update(Room $room, Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $room->update([
            'name' => $request->name,
        ]);

        return back();
    }

    public function index_withCountSeats()
    {
        $rooms = Room::withSeats();

        return view('pages/home', ['rooms' => $rooms]);
    }

    public function show($id, $datetime = null)
    {
        $date_time = Carbon::createFromDate($datetime)->toDateString();
        $roomsWithAvailable = Room::withCurrentBookings($id, $date_time);

        return View(
            'pages/seats',
            ['room' => $roomsWithAvailable, 'date_selected' => $date_time]
        );
    }

    public function show_display($id)
    {
        $rooms = Room::withTodayBookings($id);
        return View(
            'pages/display_screen',
            ['room' => $rooms]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        Room::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'You stored the room successfully');
    }
}
