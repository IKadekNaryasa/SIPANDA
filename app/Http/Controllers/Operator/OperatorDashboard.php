<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorDashboard extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $active = 'dashboard';
        $open = 'dahsboard';
        $link = 'Dashboard';
        $kendaraans = Kendaraan::where('user_id', Auth::user()->id)->get();
        return view('operator.dashboard', compact('title', 'active', 'open', 'link', 'kendaraans'));
    }
}
