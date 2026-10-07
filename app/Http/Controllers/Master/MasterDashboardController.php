<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\ApiClient;
use App\Models\User;

class MasterDashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Master';
        $active = 'dashboard';
        $open = 'dashboard';
        $link = 'Dashboard Master';
        $jumlahUserMaster = User::whereIn('role', ['admin', 'master'])->count();
        $jumlahApiClient = ApiClient::count();

        return view('master.dashboard', compact(
            'title',
            'active',
            'open',
            'link',
            'jumlahUserMaster',
            'jumlahApiClient'
        ));
    }
}
