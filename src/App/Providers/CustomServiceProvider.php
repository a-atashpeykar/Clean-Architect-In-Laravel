<?php

namespace App\Providers;

use Domain\Auth\Abstracts\CreateOtpServiceInterface;
use Domain\Auth\Abstracts\VerifyOtpServiceInterface;
use Domain\Auth\Services\CreateOtpService;
use Domain\Auth\Services\VerifyOtpService;
use Domain\User\Abstracts\FindUserServiceInterface;
use Domain\User\Services\FindUserService;
use Illuminate\Support\ServiceProvider;
use Domain\User\Services\StoreUserService;
use Domain\User\Abstracts\StoreUserServiceInterface;


class CustomServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(
			StoreUserServiceInterface::class,
			StoreUserService::class,
		);

        $this->app->bind(
            FindUserServiceInterface::class,
            FindUserService::class,
        );

        $this->app->bind(
            CreateOtpServiceInterface::class,
            CreateOtpService::class,
        );

        $this->app->bind(
            VerifyOtpServiceInterface::class,
            VerifyOtpService::class,
        );
	}

	public function boot(): void {}
}
