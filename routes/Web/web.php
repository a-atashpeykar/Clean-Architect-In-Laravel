<?php

use Illuminate\Support\Facades\Route;
use Support\RouteName;

Route::get('/test', function () {
    return response()->json("WOrking");
})->name(RouteName::home);
