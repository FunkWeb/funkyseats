<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeactivatedRestriction extends Model
{
    use HasFactory;


    public function bookingRestriction()
    {
        return $this->hasMany(BookingRestriction::class);
    }
}
