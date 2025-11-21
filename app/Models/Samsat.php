<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Samsat extends Model
{
    use HasUuids;
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'kendaraan_id',
        'tgl_samsat',
        'biaya'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
