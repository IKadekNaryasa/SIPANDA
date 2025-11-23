<?php

use App\Http\Controllers\Operator\OperatorKendaraanController;
use App\Http\Controllers\Operator\OperatorSamsatController;
use App\Http\Controllers\Operator\SamsatController;
use Illuminate\Support\Facades\Route;

Route::prefix('opt/')->name('opt.')->group(function () {
    Route::get('samsat/kendaraan-jatuh-tempo', [OperatorKendaraanController::class, 'kendaraanJatuhTempo'])->name('samsat.kendaraanJatuhTempo');
    Route::resource('samsat', OperatorSamsatController::class)->only('store');
});
