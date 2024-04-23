<?php

namespace App\Providers;

use Domain\Auth\Abstracts\AuthRepositoryInterface;
use Domain\Auth\Repositories\AuthRepository;
use Domain\Category\Abstracts\CategoryRepositoryInterface;
use Domain\Category\Repositories\CategoryRepository;
use Domain\Product\Abstracts\ProductRepositoryInterface;
use Domain\Product\Repositories\ProductRepository;
use Domain\Tag\Abstracts\TagRepositoryInterface;
use Domain\Tag\Repositories\TagRepository;
use Domain\User\Abstracts\UserRepositoryInterface;
use Domain\User\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
	public function register(): void
	{
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class,
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );

        $this->app->bind(
            TagRepositoryInterface::class,
            TagRepository::class,
        );
	}

	public function boot(): void {}
}
