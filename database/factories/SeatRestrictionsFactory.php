<?php

namespace Database\Factories;

use App\Models\SeatRestrictions;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatRestrictionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SeatRestrictions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seat_id' =>  \App\Models\Seat::all()->random()->id,
            'booking_restriction_id' =>  \App\Models\BookingRestriction::all()->random()->id,
        ];
    }
}
