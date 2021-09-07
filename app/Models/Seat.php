<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function seatType()
    {
        return $this->belongsTo(SeatType::class);
    }

    public function seatRestriction()
    {
        return $this->hasMany(SeatRestrictions::class);
    }

    public function seatEquipment()
    {
        return $this->hasMany(SeatEquipment::class);
    }
}
