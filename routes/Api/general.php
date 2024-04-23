<?php

use Illuminate\Support\Facades\Route;
use Support\RouteName;

Route::get('/health-check',function (){
    dd(
        'hello World'
    );
})->name(RouteName::healthCheck);
