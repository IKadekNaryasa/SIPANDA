<?php

use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Middleware\SipandaAuth;
use App\Http\Middleware\SIpandaGuest;
use Illuminate\Support\Facades\Route;

Route::get('login', [Authentication::class, 'login'])->name('login')->middleware(SIpandaGuest::class);
Route::post('login', [Authentication::class, 'authLogin'])->name('auth.login')->middleware(SIpandaGuest::class);
Route::get('logout', [Authentication::class, 'logout'])->name('auth.logout')->middleware(SipandaAuth::class);

Route::put('auth/change-password/{user}', [ChangePasswordController::class, 'changePassword'])->name('auth.changePassword')->middleware(SipandaAuth::class);
