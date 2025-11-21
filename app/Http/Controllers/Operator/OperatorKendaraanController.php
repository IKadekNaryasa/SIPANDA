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

        $today = now();
        $sevenDaysLater = now()->addDays(7);

        $nextMonth = now()->addMonth()->month;
        $nextYear  = now()->addMonth()->year;

        $kendaraanJatuhTempo = Kendaraan::where('user_id', Auth::id())
            ->where(function ($query) use ($today, $sevenDaysLater, $nextMonth, $nextYear) {
                $query
                    ->whereBetween('tgl_jatuh_tempo', [$today, $sevenDaysLater])

                    ->orWhere(function ($q) use ($nextMonth, $nextYear) {
                        $q->whereMonth('tgl_jatuh_tempo', $nextMonth)
                            ->whereYear('tgl_jatuh_tempo', $nextYear);
                    });
            })
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
