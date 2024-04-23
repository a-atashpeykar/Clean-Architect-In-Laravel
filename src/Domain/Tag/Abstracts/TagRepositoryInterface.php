<?php

namespace Domain\Tag\Abstracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TagRepositoryInterface
{
	public function getAllTags(): Collection;
	
	public function getAllTagsPaginated(): LengthAwarePaginator;
}