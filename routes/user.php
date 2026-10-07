<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('user/export', [UserController::class, 'export'])->name('user.export');
Route::put('user/set-status/{user}', [UserController::class, 'setStatus'])->name('user.setStatus');
Route::resource('user', UserController::class);
