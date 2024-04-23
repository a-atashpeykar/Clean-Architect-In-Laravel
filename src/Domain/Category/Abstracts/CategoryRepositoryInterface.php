<?php

namespace Domain\Category\Abstracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
	public function getAllTags(): Collection;
	
	public function getAllTagsPaginated(): LengthAwarePaginator;
}