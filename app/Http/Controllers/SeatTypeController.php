<?php

namespace App\Http\Controllers;

use App\Models\SeatType;
use Illuminate\Http\Request;

class SeatTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required'],
        ]);
        $seatType = new SeatType;
        $seatType->name = $request->name;
        $seatType->description = $request->description;

        $seatType->save();
        return back()->with('success', 'You stored the seat type successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function show(SeatType $seatType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function edit(SeatType $seatType)
    {
        return View('pages.admin.edit_seat_types', ['types' => SeatType::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeatType $seatType)
    {
        $request->validate([
            'name' => ['required',],
            'description' => ['required',],
        ]);

        $seatType->name = $request->name;
        $seatType->description = $request->description;

        $seatType->save();

        return back()->with('success', 'You updated the seat typ successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeatType $seatType)
    {
        if ($seatType) {
            $seatType->delete();
        }

        return back()->with('success', 'You deleted the seat type successfully');
    }
}
