<?php

use Illuminate\Support\Facades\Route;
use App\Api\Auth\Actions\RegisterUserAction;

Route::post('/auth/register', [RegisterUserAction::class,'register'])->name('userRegister');

Route::get('/health-check',function (){
    dd(
        'hello World'
    );
});
