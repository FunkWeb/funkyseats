<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $with = [
        'seatType',
        //'booking',
        //'seat.seatEquipment',
        //'seat.seatRestriction.restrictionDescription'
    ];

    protected $guarded = [];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function seatType()
    {
        return $this->belongsTo(SeatType::class);
    }

    public function seatRestriction()
    {
        return $this->belongsToMany(BookingRestriction::class, 'seat_restrictions');
    }

    public function seatEquipment()
    {
        return $this->belongsToMany(Equipment::class, 'seat_equipment');
    }
}
