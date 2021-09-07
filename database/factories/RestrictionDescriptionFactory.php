<?php

namespace Database\Factories;

use App\Models\RestrictionDescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestrictionDescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RestrictionDescription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'general' => false,
        ];
    }
}
