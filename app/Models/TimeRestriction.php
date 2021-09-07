<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeRestriction extends Model
{
    use HasFactory;


    public function bookingRestriction()
    {
        return $this->belongsTo(BookingRestriction::class);
    }

    public function restrictionDescription()
    {
        return $this->hasOne(RestrictionDescription::class);
    }
}
