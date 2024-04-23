<?php

namespace Database\Factories;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            "title" => $this->faker->words(2, true),
	        "price" => random_int(10, 100) + 0.99,
        ];
    }
}
