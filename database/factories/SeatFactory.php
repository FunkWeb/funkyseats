<?php

namespace Database\Factories;

use App\Models\Seat;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seat_type_id' => \App\Models\SeatType::all()->first()->id,
            'room_id' => Room::factory(),
            'seat_number' => mt_rand(1, 50),
        ];
    }
}
