<?php

namespace Database\Factories;

use App\Models\SeatEquipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatEquipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SeatEquipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'seat_id' =>  \App\Models\Seat::all()->random()->id,
            'equipment_id' =>  \App\Models\Equipment::all()->random()->id,
        ];
    }
}
