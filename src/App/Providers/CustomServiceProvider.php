<?php

namespace App\Providers;

use Domain\Auth\Abstracts\CreateOtpServiceInterface;
use Domain\Auth\Abstracts\VerifyOtpServiceInterface;
use Domain\Auth\Services\CreateOtpService;
use Domain\Auth\Services\VerifyOtpService;
use Domain\Category\Abstracts\GetAllCategoriesServiceInterface;
use Domain\Category\Services\GetAllCategoriesService;
use Domain\Product\Abstracts\AttachProductToCategoriesServiceInterface;
use Domain\Product\Abstracts\AttachTagsToProductServiceInterface;
use Domain\Product\Abstracts\GetPaginatedProductsListServiceInterface;
use Domain\Product\Abstracts\StoreProductServiceInterface;
use Domain\Product\Services\AttachProductToCategoriesService;
use Domain\Product\Services\AttachTagsToProductService;
use Domain\Product\Services\GetPaginatedProductsServiceList;
use Domain\Product\Services\StoreProductService;
use Domain\Tag\Abstracts\GetAllTagsServiceInterface;
use Domain\Tag\Services\GetAllTagsService;
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

        $this->app->bind(
            StoreProductServiceInterface::class,
            StoreProductService::class,
        );

        $this->app->bind(
            GetAllTagsServiceInterface::class,
            GetAllTagsService::class,
        );

        $this->app->bind(
            GetAllCategoriesServiceInterface::class,
            GetAllCategoriesService::class,
        );

        $this->app->bind(
            GetPaginatedProductsListServiceInterface::class,
            GetPaginatedProductsServiceList::class,
        );

        $this->app->bind(
            AttachProductToCategoriesServiceInterface::class,
            AttachProductToCategoriesService::class,
        );

        $this->app->bind(
            AttachTagsToProductServiceInterface::class,
            AttachTagsToProductService::class,
        );
	}

	public function boot(): void {}
}
