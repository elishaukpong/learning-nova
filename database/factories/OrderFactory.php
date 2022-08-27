<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()
                            ->random()
                            ->id,

            'product_id' => Product::all()
                                ->random()
                                ->id,

            'sales_date' => $this->faker
                                ->dateTimeBetween('-1 year', '+1year'),

            'quantity' => $this->faker
                            ->numberBetween(10,99)

        ];
    }
}
