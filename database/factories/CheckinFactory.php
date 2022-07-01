<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CheckinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => today()->addHours(8),
            'updated_at' => today()->addHours(8),
            'forced_checkout' => false,
            'user_id' => \App\Models\User::all()->random()->id,
            'updated_at' => NULL,
            //
        ];
    }
}
