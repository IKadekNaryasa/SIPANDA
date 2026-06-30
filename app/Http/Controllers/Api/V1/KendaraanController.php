<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\KendaraanResource;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kendaraan::query()->with('user');

        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('merk', 'like', '%' . $request->search . '%')
                    ->orWhere('model', 'like', '%' . $request->search . '%')
                    ->orWhere('nomor_polisi', 'like', '%' . $request->search . '%');
            });
        }

        $kendaraans = $query->paginate($request->per_page ?? 15);

        return KendaraanResource::collection($kendaraans)->additional([
            'status' => 'success',
        ]);
    }


    public function show(Kendaraan $kendaraan)
    {
        return (new KendaraanResource($kendaraan))
            ->additional(['status' => 'success']);
    }
}
