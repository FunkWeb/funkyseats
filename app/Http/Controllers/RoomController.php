<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    //

    public function rooms()
    {
        $rooms = new \App\Models\Room();
        return View('pages/home', ['rooms' => $rooms->index()]);
    }

    public function show($id)
    {
        return View('pages/home', ['room' => Room::where('id', $id)->with('seat')->get()]);
    }
}
