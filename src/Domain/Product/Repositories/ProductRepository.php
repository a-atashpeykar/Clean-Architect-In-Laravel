<?php

namespace Domain\Product\Repositories;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Domain\Product\DataTransferObjects\StoreProductDto;
use Domain\Product\Abstracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Domain\Product\DataTransferObjects\AttachTagsToProductDto;
use Domain\Product\DataTransferObjects\AttachProductToCategoriesDto;

class ProductRepository implements ProductRepositoryInterface
{
	public function __construct(private readonly Product $product) {}

	public function getAllProducts(): Collection
	{
		return $this->product->all();
	}

	public function getAllProductsPaginated(): LengthAwarePaginator
	{
		return $this->product->paginate(20);
	}

	public function store(StoreProductDto $dto): Product|null
	{
		return $this->product->create($dto->allowedInputs());
	}

	public function attachCategories(AttachProductToCategoriesDto $dto): array
	{
		return $dto->product->categories()->sync($dto->allowedInputs());
	}

	public function attachTags(AttachTagsToProductDto $dto): array
	{
		return $dto->product->tags()->sync($dto->allowedInputs());
	}
}
