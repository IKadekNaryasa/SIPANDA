<?php

use App\Http\Controllers\Admin\ApiClientController;
use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Middleware\SipandaAuth;
use App\Http\Middleware\SIpandaGuest;
use Illuminate\Support\Facades\Route;

Route::get('login', [Authentication::class, 'login'])->name('login')->middleware(SIpandaGuest::class);
Route::post('login', [Authentication::class, 'authLogin'])->name('auth.login')->middleware(SIpandaGuest::class);
Route::get('logout', [Authentication::class, 'logout'])->name('auth.logout')->middleware(SipandaAuth::class);

Route::put('auth/change-password/{user}', [ChangePasswordController::class, 'changePassword'])->name('auth.changePassword')->middleware(SipandaAuth::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // API Client Management
    Route::resource('api-clients', ApiClientController::class);
    Route::patch('api-clients/{apiClient}/toggle', [ApiClientController::class, 'toggleStatus'])
        ->name('api-clients.toggle');
    Route::post('api-clients/{apiClient}/resend', [ApiClientController::class, 'resendActivation'])
        ->name('api-clients.resend');
});
