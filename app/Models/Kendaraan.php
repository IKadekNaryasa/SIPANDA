<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{

    use HasUuids;
    protected $keyType = "string";
    public $incrementing = false;

    public $fillable = [
        'kode_barang',
        'jenis_barang',
        'merk_type',
        'cc',
        'tahun_pembelian',
        'N_rangka',
        'N_mesin',
        'N_polisi',
        'harga',
        'user_id',
        'tgl_jatuh_tempo',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function samsat()
    {
        return $this->hasMany(Samsat::class);
    }
}
