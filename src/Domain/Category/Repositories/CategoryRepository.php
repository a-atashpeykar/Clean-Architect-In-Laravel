<?php

namespace Domain\Category\Repositories;

use Domain\Category\Abstracts\CategoryRepositoryInterface;
use Domain\Category\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
	public function __construct(private readonly Category $category) {}
	
	public function getAllTags(): Collection
	{
		return $this->category->all();
	}
	
	public function getAllTagsPaginated(): LengthAwarePaginator
	{
		return $this->category->paginate(20);
	}
}