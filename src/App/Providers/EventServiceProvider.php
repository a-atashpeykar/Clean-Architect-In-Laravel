<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Domain\Product\Events\ProductCreated;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Domain\Product\Listeners\SendEmailAfterProductCreatedToAdmin;
use Domain\Product\Listeners\SendEmailAfterProductCreatedToProductCreator;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ProductCreated::class => [
            SendEmailAfterProductCreatedToAdmin::class,
            SendEmailAfterProductCreatedToProductCreator::class,
        ]
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
