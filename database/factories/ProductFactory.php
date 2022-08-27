<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomDigitNotNull,
            'date_published' => $this->faker->dateTimeBetween('-1 year', '+1year'),
            'is_active' => $this->faker->boolean(60)
        ];
    }
}
