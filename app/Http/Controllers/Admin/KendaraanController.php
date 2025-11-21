<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Kendaraan';
        $active = 'dataKendaraan';
        $open = 'kendaraan';
        $link = 'Kendaraan | Data Kendaraan';
        $kendaraans = Kendaraan::with('user')->latest()->get();
        return view('admin.kendaraan.index', compact('title', 'active', 'open', 'link', 'kendaraans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create New Kendaraan';
        $active = 'createKendaraan';
        $open = 'kendaraan';
        $link = 'Kendaraan | Create New Kendaraan';
        $users = User::all();
        return view('admin.kendaraan.create', compact('title', 'active', 'open', 'link', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang'      => 'required|string|max:50',
            'jenis_barang'     => 'required|string|max:100',
            'merk'             => 'required|string|max:100',
            'cc'               => 'required|numeric|min:1',
            'tahun_pembelian'  => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'N_rangka'         => 'required|string|max:100',
            'N_mesin'          => 'required|string|max:100',
            'N_polisi'         => 'required|string|max:50',
            'harga'            => 'required|numeric|min:0',
            'tgl_jatuh_tempo'  => 'required|date|after_or_equal:today',
            'user_id'          => 'required|uuid|exists:users,id',
        ], [
            'kode_barang.required'     => 'Kode barang wajib diisi.',
            'jenis_barang.required'    => 'Jenis barang wajib diisi.',
            'merk.required'            => 'Merk wajib diisi.',
            'cc.required'              => 'CC wajib diisi.',
            'cc.numeric'               => 'CC harus berupa angka.',
            'tahun_pembelian.required' => 'Tahun pembelian wajib diisi.',
            'tahun_pembelian.digits'   => 'Tahun pembelian harus 4 digit.',
            'tahun_pembelian.integer'  => 'Tahun pembelian harus berupa angka.',
            'N_rangka.required'        => 'Nomor rangka wajib diisi.',
            'N_mesin.required'         => 'Nomor mesin wajib diisi.',
            'N_polisi.required'        => 'Nomor polisi wajib diisi.',
            'harga.required'           => 'Harga wajib diisi.',
            'harga.numeric'            => 'Harga harus berupa angka.',
            'tgl_jatuh_tempo.required' => 'Tanggal jatuh tempo wajib diisi.',
            'tgl_jatuh_tempo.date'     => 'Tanggal jatuh tempo harus format tanggal yang valid.',
            'tgl_jatuh_tempo.after_or_equal' => 'Tanggal jatuh tempo tidak boleh di masa lalu.',
            'user_id.required'         => 'User ID wajib diisi.',
            'user_id.uuid'             => 'User ID harus format UUID.',
            'user_id.exists'           => 'User ID tidak ditemukan di tabel users.',
        ]);

        $sanitized = array_map(fn($value) => is_string($value) ? strip_tags($value) : $value, $validatedData);

        $data = [
            'kode_barang' => $sanitized['kode_barang'],
            'jenis_barang' => $sanitized['jenis_barang'],
            'merk_type' => $sanitized['merk'],
            'cc' => $sanitized['cc'],
            'tahun_pembelian' => $sanitized['tahun_pembelian'],
            'N_rangka' => $sanitized['N_rangka'],
            'N_mesin' => $sanitized['N_mesin'],
            'N_polisi' => $sanitized['N_polisi'],
            'harga' => $sanitized['harga'],
            'user_id' => $sanitized['user_id'],
            'tgl_jatuh_tempo' => $sanitized['tgl_jatuh_tempo'],
        ];
        try {
            DB::transaction(function () use ($data) {
                Kendaraan::create($data);
            });

            return redirect()->route('kendaraan.index')->with('success', 'Data Kendaraan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kendaraan $kendaraan)
    {
        $title = 'Edit Data Kendaraan';
        $active = 'dataKendaraan';
        $open = 'kendaraan';
        $link = 'Kendaraan | Edit Data Kendaraan';
        $users = User::all();
        return view('admin.kendaraan.edit', compact('title', 'active', 'open', 'link', 'kendaraan', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validatedData = $request->validate([
            'kode_barang'      => 'required|string|max:50',
            'jenis_barang'     => 'required|string|max:100',
            'merk'             => 'required|string|max:100',
            'cc'               => 'required|numeric|min:1',
            'tahun_pembelian'  => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'N_rangka'         => 'required|string|max:100',
            'N_mesin'          => 'required|string|max:100',
            'N_polisi'         => 'required|string|max:50',
            'harga'            => 'required|numeric|min:0',
            'tgl_jatuh_tempo'  => 'required|date|after_or_equal:today',
            'user_id'          => 'required|uuid|exists:users,id',
        ], [
            'kode_barang.required'     => 'Kode barang wajib diisi.',
            'jenis_barang.required'    => 'Jenis barang wajib diisi.',
            'merk.required'            => 'Merk wajib diisi.',
            'cc.required'              => 'CC wajib diisi.',
            'cc.numeric'               => 'CC harus berupa angka.',
            'tahun_pembelian.required' => 'Tahun pembelian wajib diisi.',
            'tahun_pembelian.digits'   => 'Tahun pembelian harus 4 digit.',
            'tahun_pembelian.integer'  => 'Tahun pembelian harus berupa angka.',
            'N_rangka.required'        => 'Nomor rangka wajib diisi.',
            'N_mesin.required'         => 'Nomor mesin wajib diisi.',
            'N_polisi.required'        => 'Nomor polisi wajib diisi.',
            'harga.required'           => 'Harga wajib diisi.',
            'harga.numeric'            => 'Harga harus berupa angka.',
            'tgl_jatuh_tempo.required' => 'Tanggal jatuh tempo wajib diisi.',
            'tgl_jatuh_tempo.date'     => 'Tanggal jatuh tempo harus format tanggal yang valid.',
            'tgl_jatuh_tempo.after_or_equal' => 'Tanggal jatuh tempo tidak boleh di masa lalu.',
            'user_id.required'         => 'User ID wajib diisi.',
            'user_id.uuid'             => 'User ID harus format UUID.',
            'user_id.exists'           => 'User ID tidak ditemukan di tabel users.',
        ]);

        $sanitized = array_map(fn($value) => is_string($value) ? strip_tags($value) : $value, $validatedData);

        $data = [
            'kode_barang' => $sanitized['kode_barang'],
            'jenis_barang' => $sanitized['jenis_barang'],
            'merk_type' => $sanitized['merk'],
            'cc' => $sanitized['cc'],
            'tahun_pembelian' => $sanitized['tahun_pembelian'],
            'N_rangka' => $sanitized['N_rangka'],
            'N_mesin' => $sanitized['N_mesin'],
            'N_polisi' => $sanitized['N_polisi'],
            'harga' => $sanitized['harga'],
            'user_id' => $sanitized['user_id'],
            'tgl_jatuh_tempo' => $sanitized['tgl_jatuh_tempo'],
        ];
        try {
            DB::transaction(function () use ($data, $kendaraan) {
                $kendaraan->update($data);
            });
            return redirect()->route('kendaraan.index')->with('success', 'Data Kendaraan berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kendaraan $kendaraan)
    {
        //
    }

    public function setStatus(Kendaraan $kendaraan, Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:active,nonactive',
        ], [
            'status.required' => 'Status required!',
            'status.in' => 'Status must be active or nonactive'
        ]);

        $status = strip_tags($validatedData['status']);
        try {
            DB::transaction(function () use ($kendaraan, $status) {
                $kendaraan->update(['status' => $status]);
            });
            return redirect()->route('kendaraan.index')->with('success', "Kendaraan berhasil di $status kan");
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data!'])->withInput();
        }
    }
}
