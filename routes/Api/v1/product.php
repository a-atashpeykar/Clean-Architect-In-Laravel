<?php

use Illuminate\Support\Facades\Route;
use App\Api\Product\Actions\StoreProductAction;
use Support\RouteName;

Route::post("/", [StoreProductAction::class, "store"])
	->name(RouteName::apiProductStore);
