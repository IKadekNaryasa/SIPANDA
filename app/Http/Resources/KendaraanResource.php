<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KendaraanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode_barang' => $this->kode_barang,
            'jenis_barang' => $this->jenis_barang,
            'merk_type' => $this->merk_type,
            'cc' => $this->cc,
            'tahun_pembelian' => $this->tahun_pembelian,
            'N_rangka' => $this->N_rangka,
            'N_mesin' => $this->N_mesin,
            'N_polisi' => $this->N_polisi,
            'harga' => $this->harga,
            'user' => new UserResource($this->whenLoaded('user')),
            'tgl_jatuh_tempo' => $this->tgl_jatuh_tempo,
            'status' => $this->status
        ];
    }
}
