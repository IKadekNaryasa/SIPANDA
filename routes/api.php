<?php

use App\Http\Controllers\Api\V1\KendaraanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('api.client')->group(function () {

    Route::apiResource('kendaraan-api', KendaraanController::class)->only(['index']);

    Route::get('/me', function (\Illuminate\Http\Request $request) {
        $client = $request->get('api_client');
        return response()->json([
            'status' => 'success',
            'data'   => [
                'name'          => $client->name,
                'email'         => $client->email,
                'status'        => $client->status,
                'last_used_at'  => $client->last_used_at,
            ]
        ]);
    });
});
