<?php

namespace App\Http\Controllers\Operator;

use App\Models\Samsat;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OperatorSamsatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kendaraan_id' => 'required|uuid|exists:kendaraans,id',
            'tgl_samsat' => 'required|date|before_or_equal:today',
            'biaya' => 'required|numeric|min:0',
            'tgl_jatuh_tempo' => 'required|date|after:tgl_samsat'
        ], [
            'kendaraan_id.required' => 'ID Kendaraan harus diisi',
            'kendaraan_id.exists' => 'Kendaraan tidak ditemukan',
            'tgl_samsat.required' => 'Tanggal samsat harus diisi',
            'tgl_samsat.date' => 'Format tanggal samsat tidak valid',
            'tgl_samsat.before_or_equal' => 'Tanggal samsat tidak boleh melebihi hari ini',
            'biaya.required' => 'Biaya harus diisi',
            'biaya.numeric' => 'Biaya harus berupa angka',
            'biaya.min' => 'Biaya minimal 0',
            'tgl_jatuh_tempo.required' => 'Tanggal jatuh tempo harus diisi',
            'tgl_jatuh_tempo.date' => 'Format tanggal jatuh tempo tidak valid',
            'tgl_jatuh_tempo.after' => 'Tanggal jatuh tempo harus setelah tanggal samsat'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $kendaraan_id = strip_tags($request->kendaraan_id);
            $tgl_samsat = strip_tags($request->tgl_samsat);
            $biaya = filter_var($request->biaya, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $tgl_jatuh_tempo = strip_tags($request->tgl_jatuh_tempo);

            $kendaraan = Kendaraan::findOrFail($kendaraan_id);

            $samsat = Samsat::create([
                'kendaraan_id' => $kendaraan_id,
                'tgl_samsat' => $tgl_samsat,
                'biaya' => $biaya
            ]);

            $kendaraan->update([
                'tgl_jatuh_tempo' => $tgl_jatuh_tempo
            ]);

            return redirect()->back()->with('success', 'Data samsat berhasil disimpan dan tanggal jatuh tempo berhasil diperbarui');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Kendaraan tidak ditemukan')->withInput();
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan data samsat: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Samsat $samsat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Samsat $samsat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Samsat $samsat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Samsat $samsat)
    {
        //
    }
}
