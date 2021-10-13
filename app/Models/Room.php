<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

<<<<<<< HEAD
=======
    protected $with = [
        'seat.seatType',
        'seat.seatEquipment',
        'seat.seatRestriction.restrictionDescription'
    ];

>>>>>>> feature-db
    public function seat()
    {
        return $this->HasMany(Seat::class);
    }
}
