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
            'type' => $this->faker->firstName(),
            'room_id' => Room::factory(),
            'seat_number' => mt_rand(1, 50),
        ];
    }
}
