<?php

namespace App\Http\Controllers\Pengawas;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengawasKendaraanController extends Controller
{
    public function index()
    {
        $title = 'Data Kendaraan';
        $active = 'dataKendaraan';
        $open = 'Data';
        $link = 'Kendaraan | Data Kendaraan';
        $kendaraans = Kendaraan::with('user')->latest()->get();
        return view('pengawas.kendaraan.index', compact('title', 'active', 'open', 'link', 'kendaraans'));
    }
}
