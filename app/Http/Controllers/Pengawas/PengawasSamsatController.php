<?php

namespace App\Http\Controllers\Pengawas;

use App\Models\Samsat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengawasSamsatController extends Controller
{
    public function index()
    {
        $title = 'History Samsat';
        $active = 'historySamsat';
        $open = 'Data';
        $link = 'Samsat | History';
        $samsats = Samsat::with('kendaraan.user')->orderBy('tgl_samsat', 'DESC')->get();
        return view('pengawas.samsat.history', compact('title', 'active', 'open', 'link', 'samsats'));
    }
}
