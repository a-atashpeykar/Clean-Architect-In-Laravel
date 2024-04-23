<?php

namespace App\Providers;

use App\Api\Product\Middlewares\ProductSpecificMiddleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    private array $apiRoutes = [
        "v1" => [
            "tag" => ["middleware" => "TagSpecificMiddleware", "prefix" => "tags"],
            "product" => ["middleware" => ProductSpecificMiddleware::class, "prefix" => "products"],
            "category" => ["middleware" => "CategorySpecificMiddleware", "prefix" => "categories"],
            "auth" => ["middleware" => "UserSpecificMiddleware", "prefix" => "users"]
        ],
        "v2" => [
            // Maybe v2 in the future
        ],
    ];

    private array $webRoutes = [
        "web" => ["middleware" => "web", "prefix" => "web"],
        "tag" => ["middleware" => "TagSpecificMiddleware", "prefix" => "admin/tags"],
        "category" => ["middleware" => "CategorySpecificMiddleware", "prefix" => "admin/categories"],
        "product" => ["middleware" => ProductSpecificMiddleware::class, "prefix" => "admin/products"],
    ];
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->bootApiRoutes();

            $this->bootWebRoutes();
        });
    }
    private function bootWebRoutes(): void
    {
        foreach ($this->webRoutes as $webRouteFileName => $webRoute) {
            Route::middleware($webRoute["middleware"])
                ->prefix($webRoute["prefix"])
                ->group(base_path(sprintf('routes/Web/%s.php', $webRouteFileName)));
        }
    }
    private function bootApiRoutes(): void
    {
        foreach ($this->apiRoutes as $apiVersion => $apiRoutes) {
            foreach ($apiRoutes as $apiFileName => $apiRoute) {
                Route::middleware($apiRoute["middleware"])
                    ->prefix(sprintf("api/%s/%s", $apiVersion, $apiRoute["prefix"]))
                    ->group(base_path(sprintf("routes/Api/%s/%s.php", $apiVersion, $apiFileName)));
            }
        }
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login-register-limiter', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('login-confirm-limiter', function (Request $request) {
            return Limit::perMinute(5)->by(url()->current() . $request->ip());
        });

        RateLimiter::for('login-resend-otp-limiter', function (Request $request) {
            return Limit::perMinute(5)->by(url()->current() . $request->ip());
        });

    }
}
