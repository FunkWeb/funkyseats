<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;


    public function seat()
    {
        return $this->belongsTo(Room::class);
    }

    public function seatRestriction()
    {
        return $this->hasMany(SeatRestrictions::class);
    }
}
