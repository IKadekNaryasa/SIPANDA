<?php

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\ApiClientController;
use App\Http\Controllers\Master\MasterDashboardController;
use App\Http\Controllers\Master\MasterUserController;
use App\Http\Controllers\ApiClientActivationController;
use App\Http\Controllers\Operator\OperatorDashboard;
use App\Http\Controllers\Pengawas\PengawasDashboardController;
use App\Http\Controllers\Pengawas\PengawasKendaraanController;
use App\Http\Controllers\Pengawas\PengawasSamsatController;
use App\Http\Middleware\SipandaAdmin;
use App\Http\Middleware\SipandaAuth;
use App\Http\Middleware\SipandaMaster;
use App\Http\Middleware\SIpandaGuest;
use App\Http\Middleware\SipandaOpeartor;
use App\Http\Middleware\SipandaPengawas;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('sipanda');
})->name('/')->middleware(SIpandaGuest::class);

Route::get('/api-activate/{token}', [ApiClientActivationController::class, 'activate'])
    ->name('api.activate');

Route::middleware('web')->group(base_path('routes/auth.php'));

Route::middleware(SipandaAuth::class)->group(function () {

    Route::middleware(SipandaAdmin::class)->group(function () {
        Route::get('dashboard', [AdminDashboard::class, 'index'])->name('dashboard.index');
        Route::middleware('web')->group(base_path('routes/kendaraan.php'));
        Route::middleware('web')->group(base_path('routes/user.php'));
    });

    Route::middleware(SipandaMaster::class)->group(function () {
        Route::get('master/dashboard', [MasterDashboardController::class, 'index'])->name('master.dashboard.index');
        Route::put('master/users/set-status/{user}', [MasterUserController::class, 'setStatus'])->name('master.user.setStatus');
        Route::resource('master/users', MasterUserController::class)
            ->only(['index', 'create', 'store', 'edit', 'update'])
            ->names('master.user');

        Route::resource('api-clients', ApiClientController::class);
        Route::patch('api-clients/{apiClient}/toggle', [ApiClientController::class, 'toggleStatus'])
            ->name('api-clients.toggle');
        Route::post('api-clients/{apiClient}/resend', [ApiClientController::class, 'resendActivation'])
            ->name('api-clients.resend');
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
