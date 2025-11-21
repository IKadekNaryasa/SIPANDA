<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Case_;

class Authentication extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|numeric|min:18',
            'password' => 'required|string|min:8'
        ], [
            'nip.numeric' => 'NIP harus berupa Angka!',
            'nip.required' => 'NIP tidak boleh kosong!',
            'nip.min' => 'NIP harus berupa minimal 18 angka',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password Harus berupa angka/huruf',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        $data = [
            'nip' => strip_tags($validated['nip']),
            'password' => strip_tags($validated['password']),
            'status' => 'active'
        ];

        try {
            if (Auth::attempt($data)) {
                $request->session()->regenerate();
                $user = Auth::user();

                if (!$user) {
                    return redirect()->back()->withErrors(['errors' => 'NIP atau Password Salah!'])->withInput();
                }

                $role = Auth::user()->role;
                $route = '';
                switch ($role) {
                    case 'admin':
                        $route = 'dashboard.index';
                        break;
                    case 'operator':
                        $route = 'opt.dashboard.index';
                        break;
                    case 'pengawas':
                        $route = 'pgws.dashboard.index';
                        break;
                    default:
                        Auth::logout();
                        return redirect()->route('login')->withErrors(['errors' => 'NIP atau Password Salah!']);
                }

                return redirect()->route($route)->with('success', 'Selamat Datang ' . Auth::user()->name);
            } else {
                return redirect()->back()->withErrors(['errors' => 'NIP atau Password Salah!'])->withInput();
            };
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'NIP atau Password Salah!'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->regenerate();
        session()->regenerateToken();
        return redirect()->route('/')->with('success', 'Anda sudah logout!');
    }
}
