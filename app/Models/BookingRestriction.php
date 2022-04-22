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

    public function DeactivatedRestriction()
    {
        return $this->hasMany(DeactivatedRestriction::class);
    }

    public function seatRestriction()
    {
        return $this->belongsToMany(Seat::class, 'seat_restrictions');
    }
    public function roleRestriction()
    {
        return $this->belongsToMany(Role::class, 'role_restrictions');
    }

    public function restrictionDescription()
    {
        return $this->belongsTo(RestrictionDescription::class);
    }

    public function seatTypeRestriction()
    {
        return $this->belongsToMany(SeatType::class, 'seat_restrictions');
    }
}
