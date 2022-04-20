<?php

namespace App\Http\Controllers;

use App\Models\SeatType;
use Illuminate\Http\Request;
use App\Models\Seat;

class SeatTypeController extends Controller
{
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
        SeatType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->with('success', 'You stored the seat type successfully');
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

        $seatType->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->with('success', 'You updated the seat typ successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $temp = SeatType::where('name', 'unknown')->get()->first();

        if (!$temp) {
            $newDefault = SeatType::create([
                'name' => 'unknown',
                'description' => 'system generated type',
            ]);
            $temp = $newDefault;
        }

        Seat::where('seat_type_id', $id)->update(['seat_type_id' => $temp->id]);

        SeatType::destroy($id);

        return back()->with('success', 'You deleted the seat type successfully');
    }
}
