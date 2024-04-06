<?php

namespace Database\Factories;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BasketProduct>
 */
class BasketProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->value('id'),
            'basket_id' => Basket::inRandomOrder()->value('id'),
            'count' => fake()->numberBetween(1,8),
        ];
    }
}
