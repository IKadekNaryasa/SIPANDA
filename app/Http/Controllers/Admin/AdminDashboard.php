<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $active = 'dashboard';
        $open = 'dahsboard';
        $link = 'Dashboard';
        $jumlahUser = User::where('status', 'active')->count();
        $jumlahKendaraan = Kendaraan::where('status', 'active')->count();

        return view('admin.dashboard', compact('title', 'active', 'open', 'link', 'jumlahKendaraan', 'jumlahUser'));
    }
}
