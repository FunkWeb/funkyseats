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
        return View('pages/seats', ['room' => Room::where('id', $id)->with('seat')->get()]);
    }
}
