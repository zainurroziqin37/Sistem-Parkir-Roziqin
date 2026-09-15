@extends('layout.app')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Tambah User Baru</h2>
        <a href="{{ route('admin.user.index') }}" class="px-4 py-2 text-sm font-medium text-slate-300 bg-blue-500/10 border border-blue-500/20 rounded-lg hover:bg-blue-500/20">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-[#071426] border border-blue-500/20 rounded-2xl p-6 shadow-xl">
        <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-blue-300/80 mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="w-full bg-black/20 border border-blue-500/20 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50" placeholder="Masukkan nama lengkap">
            </div>

            <div>
                <label class="block text-sm font-medium text-blue-300/80 mb-2">Username</label>
                <input type="text" name="username" required class="w-full bg-black/20 border border-blue-500/20 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50" placeholder="Username untuk login">
            </div>

            <div>
                <label class="block text-sm font-medium text-blue-300/80 mb-2">Password</label>
                <input type="password" name="password" required class="w-full bg-black/20 border border-blue-500/20 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50" placeholder="Minimal 6 karakter">
            </div>

            <div>
                <label class="block text-sm font-medium text-blue-300/80 mb-2">Hak Akses / Role</label>
                <select name="role" required class="w-full bg-[#0b1d36] border border-blue-500/20 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="owner">Owner</option>
                </select>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-500 shadow-[0_0_15px_rgba(37,99,235,0.4)]">
                    <i class="fa-solid fa-save mr-2"></i> Simpan User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection