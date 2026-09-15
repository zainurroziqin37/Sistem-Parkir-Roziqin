@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-blue-400 font-semibold">Master</p>
            <h2 class="mt-2 text-3xl font-bold text-white">Area Parkir</h2>
        </div>
        <a href="{{ route('admin.area.create') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-lg shadow-blue-900/30 transition hover:bg-blue-500">
            <i class="fa-solid fa-plus mr-2"></i>
            Tambah Area
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-blue-500/30 bg-[#071426] shadow-2xl shadow-blue-950/40">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-blue-100/90">
                <thead class="bg-blue-500/10 text-blue-100">
                    <tr>
                        <th class="px-5 py-3">No</th>
                        <th class="px-5 py-3">Nama Area</th>
                        <th class="px-5 py-3">Kapasitas</th>
                        <th class="px-5 py-3">Terisi</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-500/10">
                    @forelse ($areas as $area)
                        <tr class="hover:bg-blue-500/5">
                            <td class="px-5 py-4">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 font-semibold text-white">{{ $area->nama_area }}</td>
                            <td class="px-5 py-4">{{ $area->kapasitas }}</td>
                            <td class="px-5 py-4">{{ $area->terisi ?? 0 }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.area.edit', ['area' => $area->id_area]) }}" class="rounded-lg bg-blue-500/10 px-3 py-1.5 text-blue-400 transition hover:bg-blue-500/20">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.area.destroy', ['area' => $area->id_area]) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus area ini?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg bg-red-500/10 px-3 py-1.5 text-red-400 transition hover:bg-red-500/20">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-4 text-center text-slate-400">Belum ada data area parkir.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
