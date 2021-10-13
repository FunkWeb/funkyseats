<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestrictionDescription extends Model
{
    use HasFactory;


    public function bookingRestriction()
    {
        return $this->hasMany(BookingRestriction::class);
    }
    public function timeRestriction()
    {
        return $this->hasMany(TimeRestriction::class);
    }
}
