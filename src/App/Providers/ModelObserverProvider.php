<?php

namespace App\Providers;

use Domain\Tag\Models\Tag;
use Domain\User\Models\User;
use Domain\Product\Models\Product;
use Domain\Category\Models\Category;
use Domain\Tag\Observers\TagObserver;
use Domain\User\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Domain\Product\Observers\ProductObserver;
use Domain\Category\Observers\CategoryObserver;

class ModelObserverProvider extends ServiceProvider
{
	public function register(): void {}
	
	public function boot(): void
	{
		Tag::observe(TagObserver::class);
		User::observe(UserObserver::class);
		Product::observe(ProductObserver::class);
		Category::observe(CategoryObserver::class);
	}
}
