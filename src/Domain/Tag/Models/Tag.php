<?php

namespace Domain\Tag\Models;

use Illuminate\Database\Eloquent\Model;
use Domain\Tag\Collections\TagCollection;
use Domain\Tag\QueryBuilders\TagQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
	use HasFactory;
	
	public function newEloquentBuilder($query): TagQueryBuilder
	{
		return new TagQueryBuilder($query);
	}
	
	public function newCollection(array $models = []): TagCollection
	{
		return new TagCollection($models);
	}
}