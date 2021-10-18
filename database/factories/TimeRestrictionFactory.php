<?php

namespace Database\Factories;

use App\Models\TimeRestriction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TimeRestrictionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeRestriction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_restriction_id' => \App\Models\Booking::all()->random()->id,
            'time_interval_type' => 'H',
            'min_time' => 4,
            'max_time' => 8,
        ];
    }
}
