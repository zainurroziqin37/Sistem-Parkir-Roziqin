@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Kelola Data User</h2>
            <p class="text-sm text-slate-400">Daftar pengguna sistem aplikasi parkir</p>
        </div>
        <a href="{{ route('admin.user.create') }}" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-500 transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)]">
            <i class="fa-solid fa-plus mr-2"></i> Tambah User
        </a>
    </div>

    <div class="bg-[#071426] border border-blue-500/20 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-blue-500/10 text-blue-300 uppercase text-xs border-b border-blue-500/20">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Role / Hak Akses</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-500/10">
                    @forelse($users as $index => $u)
                    <tr class="hover:bg-blue-500/5 transition-colors">
                        <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-semibold text-white">{{ $u->nama_lengkap }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ $u->username }}</td>
                        <td class="px-6 py-4">
                            @if(strtolower($u->role) === 'admin')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-500/20 text-purple-400 border border-purple-500/30">ADMIN</span>
                            @elseif(strtolower($u->role) === 'petugas')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">PETUGAS</span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-500/20 text-amber-400 border border-amber-500/30">OWNER</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <a href="{{ route('admin.user.edit', $u->id) }}" class="p-2 text-amber-400 bg-amber-500/10 border border-amber-500/20 rounded-lg hover:bg-amber-500/20">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            @if (Auth::id() === $u->id)
                                <span class="group relative p-2 text-slate-600 bg-slate-500/10 border border-slate-500/20 rounded-lg cursor-not-allowed" title="Akun yang sedang digunakan tidak dapat dihapus">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                            @else
                                <form action="{{ route('admin.user.destroy', $u->id) }}" method="POST" data-confirm="Yakin hapus user ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 bg-red-500/10 border border-red-500/20 rounded-lg hover:bg-red-500/20">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data user.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection