<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;


    public function index()
    {
        return Room::with('seat.seatType')->get();
    }


    public function seat()
    {
        return $this->HasMany(Seat::class);
    }
}
