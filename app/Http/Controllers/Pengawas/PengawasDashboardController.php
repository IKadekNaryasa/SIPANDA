<?php

namespace App\Http\Controllers\Pengawas;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengawasDashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $active = 'dashboard';
        $open = 'dahsboard';
        $link = 'Dashboard';
        $jumlahKendaraan = Kendaraan::where('status', 'active')->count();

        return view('pengawas.dashboard', compact('title', 'active', 'open', 'link', 'jumlahKendaraan'));
    }
}
