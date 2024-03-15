<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category)
        {
            for($i = 0; $i < 3; $i++)
            {
                $category->photos()->create(
                    [
                        'url' => fake()->imageUrl(),
                    ]
                );
            }
        });
    }
}
