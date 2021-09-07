<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRestriction extends Model
{
    use HasFactory;

    public function timeRestriction()
    {
        return $this->hasMany(TimeRestriction::class);
    }

    public function seatRestriction()
    {
        return $this->hasMany(SeatRestrictions::class);
    }
}
