<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from' => now(),
            'to' => now()->addHours(4),
            'approved' => true,
            'seat_id' => \App\Models\Seat::all()->random()->id,
            'user_id' => \App\Models\User::all()->random()->id,
        ];
    }
}
