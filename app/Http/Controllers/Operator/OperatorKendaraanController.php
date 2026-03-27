<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorKendaraanController extends Controller
{
    public function kendaraanJatuhTempo()
    {
        $title = 'Jatuh Tempo';
        $active = 'jatuhTempo';
        $open = 'samsat';
        $link = 'Kendaraan | Jatuh Tempo';

        $threeMonthsLater = now()->addMonths(3)->endOfDay();

        $kendaraanJatuhTempo = Kendaraan::where('user_id', Auth::id())
            ->where('tgl_jatuh_tempo', '<=', $threeMonthsLater)
            ->orderBy('tgl_jatuh_tempo', 'asc')
            ->get();

        return view('operator.kendaraan.jatuh_tempo', compact(
            'title',
            'active',
            'open',
            'link',
            'kendaraanJatuhTempo'
        ));
    }
}
