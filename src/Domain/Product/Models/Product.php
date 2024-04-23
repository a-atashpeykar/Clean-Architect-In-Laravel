<?php

namespace Domain\Product\Models;

use Support\TableName;
use Domain\Tag\Models\Tag;
use Database\Factories\UserFactory;
use Domain\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Domain\Product\Collections\ProductCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Domain\Product\QueryBuilders\ProductQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected static function newFactory(): UserFactory
	{
		return new UserFactory();
	}

	public function newCollection(array $models = []): ProductCollection
	{
		return new ProductCollection($models);
	}

	public function newEloquentBuilder($query): ProductQueryBuilder
	{
		return new ProductQueryBuilder($query);
	}

	public function categories(): BelongsToMany
	{
		return $this->morphToMany(Category::class, 'categorable', TableName::categorable);
	}

	public function tags(): MorphToMany
	{
		return $this->morphToMany(Tag::class, 'taggable', TableName::taggable);
	}
}
