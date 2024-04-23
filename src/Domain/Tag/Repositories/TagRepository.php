<?php

namespace Domain\Tag\Repositories;

use Domain\Tag\Abstracts\TagRepositoryInterface;
use Domain\Tag\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TagRepository implements TagRepositoryInterface
{
	public function __construct(private readonly Tag $tag) {}
	
	public function getAllTags(): Collection
	{
		return $this->tag->all();
	}
	
	public function getAllTagsPaginated(): LengthAwarePaginator
	{
		// I am using magic number over here and hard codded value just for simplicity.
		return $this->tag->paginate(20);
	}
}