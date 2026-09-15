@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-blue-400 font-semibold">Master</p>
            <h2 class="mt-2 text-3xl font-bold text-white">Master Tarif</h2>
        </div>
        <!-- Diubah ke rute admin.tarif.create sesuai web.php guru -->
        <a href="{{ route('admin.tarif.create') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-lg shadow-blue-900/30 transition hover:bg-blue-500">
            <i class="fa-solid fa-plus mr-2"></i>
            Tambah Tarif
        </a>
    </div>

    <!-- Alert Notifikasi Sukses -->
    <div class="overflow-hidden rounded-2xl border border-blue-500/30 bg-[#071426] shadow-2xl shadow-blue-950/40">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-blue-100/90">
                <thead class="bg-blue-500/10 text-blue-100">
                    <tr>
                        <th class="px-5 py-3">No</th>
                        <th class="px-5 py-3">Jenis Kendaraan</th>
                        <th class="px-5 py-3">Tarif / Jam</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-500/10">
                    <!-- Menampilkan data dinamis dari TarifController -->
                    @forelse ($tarifs as $tarif)
                        <tr class="hover:bg-blue-500/5">
                            <td class="px-5 py-4">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 font-semibold text-white">{{ $tarif->jenis_kendaraan }}</td>
                            <td class="px-5 py-4">Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.tarif.edit', $tarif->id_tarif) }}" class="rounded-lg bg-blue-500/10 px-2 py-1.5 text-blue-200 hover:bg-blue-500/20">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('admin.tarif.destroy', $tarif->id_tarif) }}" method="POST" data-confirm="Hapus tarif ini?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg bg-red-500/10 px-2 py-1.5 text-red-200 hover:bg-red-500/20">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-4 text-center text-slate-400">Belum ada data tarif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection