@extends('layout.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-semibold text-white">Data Kendaraan</h2>
        <p class="mt-1 text-sm text-blue-100">Kelola data seluruh kendaraan yang terdaftar.</p>
    </div>
    <a href="{{ route('admin.kendaraan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
        <i class="fa-solid fa-plus mr-2"></i>Tambah Kendaraan
    </a>
</div>

<div class="overflow-hidden rounded-2xl border border-blue-500/30 bg-[#071426] shadow-2xl shadow-blue-950/40">
    <div class="overflow-x-auto">
        <table class="min-w-full whitespace-nowrap text-left text-sm text-blue-100">
            <thead class="border-b border-blue-500/20 bg-blue-500/10 text-xs font-semibold uppercase text-blue-100">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Plat Nomor</th>
                    <th class="px-6 py-4">Jenis</th>
                    <th class="px-6 py-4">Warna</th>
                    <th class="px-6 py-4">Pemilik</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-500/10">
                @forelse($kendaraans as $kendaraan)
                <tr class="transition-colors hover:bg-blue-500/10">
                    <td class="px-6 py-4 text-blue-100">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-bold text-white">{{ $kendaraan->plat_nomor }}</td>
                    <td class="px-6 py-4"><span class="rounded-full border border-blue-400/30 bg-blue-500/20 px-2.5 py-0.5 text-xs font-medium text-blue-100">{{ ucfirst($kendaraan->jenis_kendaraan) }}</span></td>
                    <td class="px-6 py-4 text-blue-100">{{ $kendaraan->warna }}</td>
                    <td class="px-6 py-4 text-blue-100">{{ $kendaraan->pemilik }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.kendaraan.edit', $kendaraan->id_kendaraan) }}" class="mr-1 rounded-lg border border-blue-400/20 bg-blue-500/10 p-2 text-blue-200 hover:bg-blue-500/20"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.kendaraan.destroy', $kendaraan->id_kendaraan) }}" method="POST" class="inline" data-confirm="Yakin hapus kendaraan ini?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg border border-red-400/20 bg-red-500/10 p-2 text-red-300 hover:bg-red-500/20"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-8 text-center text-blue-200">Belum ada data kendaraan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection