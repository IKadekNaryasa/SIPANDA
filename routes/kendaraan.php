<?php

use App\Http\Controllers\Admin\KendaraanController;
use Illuminate\Support\Facades\Route;

Route::put('kendaraan/set-status/{kendaraan}', [KendaraanController::class, 'setStatus'])->name('kendaraan.setStatus');
Route::resource('kendaraan', KendaraanController::class);
