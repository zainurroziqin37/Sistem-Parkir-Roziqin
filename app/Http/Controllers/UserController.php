<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        public function index()
    {
        $users = User::orderByRaw("
                CASE LOWER(role)
                    WHEN 'owner' THEN 1
                    WHEN 'admin' THEN 2
                    WHEN 'petugas' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('id')
            ->get();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|unique:tb_user,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,petugas,owner',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|unique:tb_user,username,' . $user->id,
            'role'     => 'required|in:admin,petugas,owner',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'role'     => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!');
    }
}