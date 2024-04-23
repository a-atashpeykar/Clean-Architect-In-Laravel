<?php

namespace Database\Factories;

use Domain\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            "title" => $this->faker->words(2, true),
        ];
    }
}
