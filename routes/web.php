<?php

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Operator\OperatorDashboard;
use App\Http\Controllers\Pengawas\PengawasDashboardController;
use App\Http\Controllers\Pengawas\PengawasKendaraanController;
use App\Http\Controllers\Pengawas\PengawasSamsatController;
use App\Http\Middleware\SIpandaGuest;
use App\Http\Middleware\SipandaAdmin;
use App\Http\Middleware\SipandaAuth;
use App\Http\Middleware\SipandaOpeartor;
use App\Http\Middleware\SipandaPengawas;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('sipanda');
})->name('/')->middleware(SIpandaGuest::class);

Route::middleware('web')->group(base_path('routes/auth.php'));

Route::middleware(SipandaAuth::class)->group(function () {

    Route::middleware(SipandaAdmin::class)->group(function () {
        Route::get('dashboard', [AdminDashboard::class, 'index'])->name('dashboard.index');
        Route::middleware('web')->group(base_path('routes/kendaraan.php'));
        Route::middleware('web')->group(base_path('routes/user.php'));
    });

    Route::middleware(SipandaOpeartor::class)->group(function () {
        Route::get('opt/dashboard', [OperatorDashboard::class, 'index'])->name('opt.dashboard.index');
        Route::middleware('web')->group(base_path('routes/samsat.php'));
    });

    Route::middleware(SipandaPengawas::class)->group(function () {
        Route::get('pgws/dashboard', [PengawasDashboardController::class, 'index'])->name('pgws.dashboard.index');
        Route::get('pgws/kendaraan', [PengawasKendaraanController::class, 'index'])->name('pgws.kendaraan.index');
        Route::get('pgws/samsat', [PengawasSamsatController::class, 'index'])->name('pgws.samsat.index');
    });
});
