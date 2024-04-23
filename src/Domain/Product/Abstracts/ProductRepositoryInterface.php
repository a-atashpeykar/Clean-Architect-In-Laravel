<?php

namespace Domain\Product\Abstracts;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Domain\Product\DataTransferObjects\StoreProductDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Domain\Product\DataTransferObjects\AttachTagsToProductDto;
use Domain\Product\DataTransferObjects\AttachProductToCategoriesDto;

interface ProductRepositoryInterface
{
	public function getAllProducts(): Collection;
	public function getAllProductsPaginated(): LengthAwarePaginator;
	public function store(StoreProductDto $dto): Product|null;
	public function attachCategories(AttachProductToCategoriesDto $dto): array;
	public function attachTags(AttachTagsToProductDto $dto): array;
}