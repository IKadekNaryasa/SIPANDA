<?php

namespace App\Http\Middleware;

use App\Models\ApiClient;
use Closure;
use Illuminate\Http\Request;

class ApiClientAuth
{
    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();

        if (!$bearerToken) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Token tidak ditemukan. Sertakan Authorization: Bearer {token}',
            ], 401);
        }

        $hashedToken = hash('sha256', $bearerToken);
        $client = ApiClient::where('token', $hashedToken)->first();

        if (!$client) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Token tidak valid',
            ], 401);
        }

        if (!$client->isActive()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Token tidak aktif atau sudah expired',
            ], 403);
        }

        $client->update(['last_used_at' => now()]);

        $request->merge(['api_client' => $client]);

        return $next($request);
    }
}
