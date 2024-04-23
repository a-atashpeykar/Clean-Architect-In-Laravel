<?php

use App\Api\Auth\Actions\LoginAction;
use App\Api\Auth\Actions\VerifyOtpAction;
use Illuminate\Support\Facades\Route;
use App\Api\Auth\Actions\RegisterUserAction;
use Support\RouteName;

Route::post('/auth/register', [RegisterUserAction::class,'register'])->name(RouteName::userRegister);
Route::post('/auth/login', [LoginAction::class,'login'])->name(RouteName::login);
Route::post('/auth/verify', [VerifyOtpAction::class,'verify'])->name(RouteName::verifyOtp);
