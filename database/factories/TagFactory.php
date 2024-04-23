<?php

namespace Database\Factories;

use Domain\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
	protected $model = Tag::class;

    public function definition(): array
    {
	    return [
		    "title" => $this->faker->words(2, true),
	    ];
    }
}
