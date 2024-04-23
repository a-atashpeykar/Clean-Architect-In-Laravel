<?php

namespace Domain\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Domain\Category\Collections\CategoryCollection;
use Domain\Category\QueryBuilders\CategoryQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
	use HasFactory;
	
	protected $guarded = [];
	
	public function newEloquentBuilder($query): CategoryQueryBuilder
	{
		return new CategoryQueryBuilder($query);
	}
	
	public function newCollection(array $models = []): CategoryCollection
	{
		return new CategoryCollection($models);
	}
}