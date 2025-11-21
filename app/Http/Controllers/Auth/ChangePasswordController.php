<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function changePassword(User $user, Request $request)
    {
        $validated = $request->validate([
            'oldPassword'          => 'required',
            'newPassword'          => 'required|min:8',
            'confirmNewPassword'   => 'required|same:newPassword',
        ], [
            'oldPassword.required' => 'Password lama wajib diisi!',
            'newPassword.required' => 'Password baru wajib diisi!',
            'newPassword.min'      => 'Password baru minimal 8 karakter!',
            'confirmNewPassword.required' => 'Konfirmasi password wajib diisi!',
            'confirmNewPassword.same'     => 'Konfirmasi password tidak sesuai dengan password baru!',
        ]);

        if (!Hash::check($request->oldPassword, $user->password)) {
            return back()->withErrors([
                'oldPassword' => 'Password lama yang Anda masukkan salah.',
            ]);
        }

        if (Hash::check($request->newPassword, $user->password)) {
            return back()->withErrors([
                'newPassword' => 'Password baru tidak boleh sama dengan password lama.',
            ]);
        }

        try {
            $user->update([
                'password' => Hash::make($request->newPassword),
            ]);
            Auth::logout();
            session()->regenerate();
            session()->regenerateToken();
            return redirect()->route('login')->with('success', 'Password berhasil di update,silakan login kembali!');
        } catch (Exception $e) {
            return back()->withErrors(['errors' => 'Password gagal di update!']);
        }
    }
}
