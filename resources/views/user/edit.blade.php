@extends('layout.app')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Edit Data User</h2>
        <a href="{{ route('admin.user.index') }}" class="px-4 py-2 text-sm font-medium text-slate-300 bg-blue-500/10 border border-blue-500/20 rounded-lg hover:bg-blue-500/20">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-[#071426] border border-blue-500/20 rounded-2xl p-6 shadow-xl">
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-blue-300/80 mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required class="w-full bg-black/20 border border-blue-500/20 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50">
            </div>

            <div>
                <label class="block text-sm font-medium text-blue-300/80 mb-2">Username</label>
                <input type="text" name="username" value="{{ $user->username }}" required class="w-full bg-black/20 border border-blue-500/20 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50">
            </div>

            <div>
                <label class="block text-sm font-medium text-blue-300/80 mb-2">Password Baru <span class="text-xs text-slate-400 font-normal">(Kosongkan jika tidak ingin diubah)</span></label>
                <input type="password" name="password" class="w-full bg-black/20 border border-blue-500/20 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50" placeholder="Password baru...">
            </div>

            <div>
                <label class="block text-sm font-medium text-blue-300/80 mb-2">Hak Akses / Role</label>
                <select name="role" required class="w-full bg-[#0b1d36] border border-blue-500/20 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50">
                    <option value="admin" {{ strtolower($user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ strtolower($user->role) === 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="owner" {{ strtolower($user->role) === 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-500 shadow-[0_0_15px_rgba(37,99,235,0.4)]">
                    <i class="fa-solid fa-save mr-2"></i> Perbarui User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection