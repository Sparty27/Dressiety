<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'available' => fake()->boolean(),
//            'category_id' => Category::inRandomOrder()->value('id'),
            'count' => fake()->numberBetween(1,100),
            'price' => fake()->numberBetween(100, 60000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product)
        {
            for($i = 0; $i < 3; $i++)
            {
                $product->photos()->create(
                    [
                        'url' => fake()->imageUrl(),
                    ]
                );
            }

            $product->tags()->sync(
                Tag::inRandomOrder()->take(4)->pluck('id')->toArray()
            );
        });
    }
}
