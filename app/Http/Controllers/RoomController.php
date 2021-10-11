<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    //

    public function rooms()
    {
        $rooms = new \App\Models\Room();
        return View('pages/home', ['rooms' => $rooms->index()]);
    }
}
