<?php

namespace Tests\Feature\Product;

use Tests\TestCase;
use Support\RouteName;
use Domain\Tag\Models\Tag;
use Domain\Category\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreProductTest extends TestCase
{
	use RefreshDatabase, WithFaker;

	protected function setUp(): void
	{
		parent::setUp();

		$this->withHeaders([
			"Accept" => "application/json"
		]);

		$this->setUpLoggedInUser();
	}

	public function testStoreProductSuccessfully()
	{
		$category1 = Category::factory()->create();
		$category2 = Category::factory()->create();
		$tag1 = Tag::factory()->create();
		$tag2 = Tag::factory()->create();

		$productData = [
			'title' => $this->faker->sentence,
			'price' => $this->faker->randomFloat(2, 1, 100),
			'categoriesId' => [$category1->id, $category2->id],
			'tagsId' => [$tag1->id, $tag2->id],
		];

		$response = $this->post(route(RouteName::apiProductStore), $productData);

        $response->assertStatus(201)
			->assertJson([
				'success' => true,
				"message" => "",
				'data' => [
					'title' => $productData['title'],
					'price' => $productData['price'],
				],
			]);

		$this->assertDatabaseHas('products', [
			'title' => $productData['title'],
			'price' => $productData['price'],
		]);
	}

	public function testStoreProductWithInvalidData()
	{
		$response = $this->post(route(RouteName::apiProductStore), [
			'title' => '',
			'price' => -1,
		]);

		$response->assertStatus(422)
			->assertJson([
				'message' => 'The title field is required. (and 1 more error)',
				'errors' => [
					'title' => ['The title field is required.'],
					'price' => ['The price field must be greater than 0.'],
				],
			]);
	}
}
