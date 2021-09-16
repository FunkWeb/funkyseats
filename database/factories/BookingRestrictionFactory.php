<?php

namespace Database\Factories;

use App\Models\BookingRestriction;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingRestrictionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingRestriction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_bookable' => (bool)random_int(0, 1),
            'needs_approval' => false,
            'restriction_description_id' => \App\Models\RestrictionDescription::all()->random()->id,
        ];
    }
}
