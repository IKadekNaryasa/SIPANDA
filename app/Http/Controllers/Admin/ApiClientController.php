<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApiClientActivateMail;
use App\Models\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ApiClientController extends Controller
{
    public function index()
    {
        $title = 'Data API Client';
        $active = 'dataApiClient';
        $open = 'api';
        $link = 'API | Data API Client';
        $clients = ApiClient::latest()->paginate(10);
        return view('admin.api-clients.index', compact('clients', 'title', 'active', 'open', 'link'));
    }

    public function create()
    {
        $title = 'Data API Client';
        $active = 'createApiClient';
        $open = 'api';
        $link = 'API | Create API Client';
        return view('admin.api-clients.create', compact('title', 'active', 'open', 'link'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:api_clients,email',
            'name'  => 'required|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $plainToken      = Str::random(64);
        $activationToken = Str::random(64);

        $client = ApiClient::create([
            'email'                  => $request->email,
            'name'                   => $request->name,
            'notes'                  => $request->notes,
            'token'                  => hash('sha256', $plainToken),
            'activation_token'       => hash('sha256', $activationToken),
            'activation_token_used'  => false,
            'activation_expired_at'  => now()->addHours(48),
            'status'                 => 'nonactive',
        ]);

        Mail::to($client->email)->send(
            new  ApiClientActivateMail($client, $activationToken)
        );

        return redirect()->route('api-clients.index')
            ->with('success', 'API Client berhasil dibuat dan email aktivasi telah dikirim.');
    }

    public function show(ApiClient $apiClient)
    {
        return view('admin.api-clients.show', compact('apiClient'));
    }

    public function toggleStatus(ApiClient $apiClient)
    {
        $newStatus = $apiClient->status === 'active' ? 'nonactive' : 'active';
        $apiClient->update(['status' => $newStatus]);

        return back()->with('success', "Token berhasil di-" . ($newStatus === 'active' ? 'aktifkan' : 'nonaktifkan') . ".");
    }

    public function resendActivation(ApiClient $apiClient)
    {
        if ($apiClient->status === 'active') {
            return back()->with('error', 'Token sudah aktif, tidak perlu aktivasi ulang.');
        }

        $activationToken = Str::random(64);
        $apiClient->update([
            'activation_token'      => hash('sha256', $activationToken),
            'activation_token_used' => false,
            'activation_expired_at' => now()->addHours(48),
        ]);

        Mail::to($apiClient->email)->send(
            new  ApiClientActivateMail($apiClient, $activationToken)
        );

        return back()->with('success', 'Email aktivasi berhasil dikirim ulang.');
    }

    // Hapus API Client
    public function destroy(ApiClient $apiClient)
    {
        $apiClient->delete();
        return redirect()->route('api-clients.index')
            ->with('success', 'API Client berhasil dihapus.');
    }
}
