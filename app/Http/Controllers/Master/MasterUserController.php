<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterUserController extends Controller
{
    public function index()
    {
        $title = 'User Master';
        $active = 'masterUsers';
        $open = 'masterUsers';
        $link = 'Master | User Master';
        $users = User::whereIn('role', ['admin', 'master'])->latest()->get();

        return view('master.user.index', compact('title', 'active', 'open', 'link', 'users'));
    }

    public function create()
    {
        $title = 'Tambah User Master';
        $active = 'createMasterUser';
        $open = 'masterUsers';
        $link = 'Master | Tambah User Master';
        $availableRoles = ['admin', 'master'];

        return view('master.user.create', compact('title', 'active', 'open', 'link', 'availableRoles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'role' => 'required|in:admin,master',
            'wa' => 'required|string',
        ]);

        $data = [
            'name' => strip_tags($validatedData['nama']),
            'nip' => strip_tags($validatedData['nip']),
            'role' => $validatedData['role'],
            'wa' => strip_tags($validatedData['wa']),
            'password' => Hash::make(substr($validatedData['nip'], -8)),
        ];

        try {
            DB::transaction(fn () => User::create($data));

            return redirect()->route('master.user.index')->with('success', 'Data user berhasil disimpan.');
        } catch (Exception $e) {
            report($e);

            return redirect()->back()
                ->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }

    public function edit(User $user)
    {
        abort_unless(in_array($user->role, ['admin', 'master'], true), 404);

        $title = 'Edit User Master';
        $active = 'masterUsers';
        $open = 'masterUsers';
        $link = 'Master | Edit User Master';
        $availableRoles = ['admin', 'master'];

        return view('master.user.edit', compact('title', 'active', 'open', 'link', 'user', 'availableRoles'));
    }

    public function update(Request $request, User $user)
    {
        abort_unless(in_array($user->role, ['admin', 'master'], true), 404);

        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'role' => 'required|in:admin,master',
            'wa' => 'required|string',
        ]);

        try {
            DB::transaction(fn () => $user->update([
                'name' => strip_tags($validatedData['nama']),
                'nip' => strip_tags($validatedData['nip']),
                'role' => $validatedData['role'],
                'wa' => strip_tags($validatedData['wa']),
            ]));

            return redirect()->route('master.user.index')->with('success', 'Data user berhasil diupdate.');
        } catch (Exception $e) {
            report($e);

            return redirect()->back()
                ->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }

    public function setStatus(User $user, Request $request)
    {
        abort_unless(in_array($user->role, ['admin', 'master'], true), 404);

        $validatedData = $request->validate([
            'status' => 'required|in:active,nonactive',
        ]);

        try {
            DB::transaction(fn () => $user->update(['status' => $validatedData['status']]));

            return redirect()->route('master.user.index')
                ->with('success', "User berhasil di {$validatedData['status']} kan");
        } catch (Exception $e) {
            report($e);

            return redirect()->back()
                ->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data!'])
                ->withInput();
        }
    }
}
