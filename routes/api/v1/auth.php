<?php

use App\Api\Auth\Actions\LoginAction;
use App\Api\Auth\Actions\VerifyOtpAction;
use Illuminate\Support\Facades\Route;
use App\Api\Auth\Actions\RegisterUserAction;

Route::post('/auth/register', [RegisterUserAction::class,'register'])->name('userRegister');
Route::post('/auth/login', [LoginAction::class,'login'])->name('login');
Route::post('/auth/verify', [VerifyOtpAction::class,'verify'])->name('verifyOtp');
