<?php

namespace App\Http\Controllers;

use App\Mail\ApiClientTokenMail;
use App\Models\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ApiClientActivationController extends Controller
{
    public function activate(string $activationToken)
    {
        $hashedActivation = hash('sha256', $activationToken);
        $client = ApiClient::where('activation_token', $hashedActivation)->first();

        if (!$client) {
            return view('api-clients.activate', [
                'error' => 'Link aktivasi tidak valid.'
            ]);
        }

        if ($client->activation_token_used) {
            return view('api-clients.activate', [
                'error' => 'Link aktivasi ini sudah pernah digunakan.'
            ]);
        }

        if (now()->gt($client->activation_expired_at)) {
            return view('api-clients.activate', [
                'error' => 'Link aktivasi sudah expired. Hubungi admin untuk mendapatkan link baru.'
            ]);
        }

        $newPlainToken = Str::random(64);

        $client->update([
            'token'                 => hash('sha256', $newPlainToken),
            'activation_token_used' => true,
            'status'                => 'active',
            'activated_at'          => now(),
        ]);

        Mail::to($client->email)->send(new ApiClientTokenMail($client, $newPlainToken));

        return view('api-clients.activate', [
            'token'  => $newPlainToken,
            'client' => $client,
        ]);
    }
}
