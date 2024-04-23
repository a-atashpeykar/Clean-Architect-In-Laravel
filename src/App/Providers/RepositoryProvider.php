<?php

namespace App\Providers;

use Domain\Auth\Abstracts\AuthRepositoryInterface;
use Domain\Auth\Repositories\AuthRepository;
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
	}

	public function boot(): void {}
}
