<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Support\ExcelDownload;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data User';
        $active = 'dataUser';
        $open = 'user';
        $link = 'User | Data User';
        $users = User::whereIn('role', ['operator', 'pengawas'])->latest()->get();
        return view('admin.user.index', compact('title', 'active', 'open', 'link', 'users'));
    }

    public function export()
    {
        $users = User::whereIn('role', ['operator', 'pengawas'])
            ->orderBy('name')
            ->get(['name', 'nip', 'wa', 'status', 'role', 'created_at', 'updated_at']);

        $rows = $users->map(fn (User $user) => [
            $user->name,
            $user->nip,
            $user->wa,
            $user->status,
            $user->role,
            $user->created_at?->format('Y-m-d H:i:s'),
            $user->updated_at?->format('Y-m-d H:i:s'),
        ]);

        return ExcelDownload::download(
            'data-user.xlsx',
            'Data User',
            ['Nama', 'NIP', 'WhatsApp', 'Status', 'Role', 'Dibuat', 'Diperbarui'],
            $rows,
            [1, 2, 3, 4, 5, 6, 7]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create New User';
        $active = 'createUser';
        $open = 'user';
        $link = 'User | Create New User';
        $availableRoles = ['operator', 'pengawas'];
        return view('admin.user.create', compact('title', 'active', 'open', 'link', 'availableRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'role' => 'required|in:operator,pengawas',
            'wa' => 'string|required'
        ], [
            'nama.required' => "Nama required!",
            'nama.string' => 'Nama must be type of text',
            'nip.required' => "NIP required!",
            'nip.numeric' => 'NIP must be type of number',
            'role.required' => 'Role required!',
            'role.in' => 'Role must be operator or pengawas',
            'wa.required' => 'WhatsApp required!',
            'wa.string' => 'whatsApp must be type of text'
        ]);

        $password = substr($validatedData['nip'], -8);
        $data = [
            'name' => strip_tags($validatedData['nama']),
            'nip' => strip_tags($validatedData['nip']),
            'role' => strip_tags($validatedData['role']),
            'wa' => strip_tags($validatedData['wa']),
            'password' => Hash::make($password)
        ];

        try {
            DB::transaction(function () use ($data) {
                User::create($data);
            });

            return redirect()->route('user.index')->with('success', 'Data user berhasil disimpan.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_unless(in_array($user->role, ['operator', 'pengawas'], true), 404);

        $title = 'Edit Data User';
        $active = 'dataUser';
        $open = 'user';
        $link = 'User | Edit Data User';
        $availableRoles = ['operator', 'pengawas'];
        return view('admin.user.edit', compact('title', 'active', 'open', 'link', 'user', 'availableRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        abort_unless(in_array($user->role, ['operator', 'pengawas'], true), 404);

        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'role' => 'required|in:operator,pengawas',
            'wa' => 'string|required'
        ], [
            'nama.required' => "Nama required!",
            'nama.string' => 'Nama must be type of text',
            'nip.required' => "NIP required!",
            'nip.numeric' => 'NIP must be type of number',
            'role.required' => 'Role required!',
            'role.in' => 'Role must be operator or pengawas',
            'wa.required' => 'WhatsApp required!',
            'wa.string' => 'whatsApp must be type of text'
        ]);

        $data = [
            'name' => strip_tags($validatedData['nama']),
            'nip' => strip_tags($validatedData['nip']),
            'role' => strip_tags($validatedData['role']),
            'wa' => strip_tags($validatedData['wa']),
        ];

        try {
            DB::transaction(function () use ($data, $user) {
                $user->update($data);
            });

            return redirect()->route('user.index')->with('success', 'Data user berhasil diupdate.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function setStatus(User $user, Request $request)
    {
        abort_unless(in_array($user->role, ['operator', 'pengawas'], true), 404);

        $validatedData = $request->validate([
            'status' => 'required|in:active,nonactive',
        ], [
            'status.required' => 'Status required!',
            'status.in' => 'Status must be active or nonactive'
        ]);

        $status = strip_tags($validatedData['status']);
        try {
            DB::transaction(function () use ($user, $status) {
                $user->update(['status' => $status]);
            });
            return redirect()->route('user.index')->with('success', "User berhasil di $status kan");
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Terjadi kesalahan saat menyimpan data!'])->withInput();
        }
    }
}
