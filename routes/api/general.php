<?php

use Illuminate\Support\Facades\Route;

Route::get('/health-check',function (){
    dd(
        'hello World'
    );
});
