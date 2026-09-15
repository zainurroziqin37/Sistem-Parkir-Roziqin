@extends('layout.app')

@section('content')
<div class="space-y-8">
    {{-- Header Page --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-blue-400 font-semibold">Transaksi Pos Parkir</p>
            <h2 class="mt-1 text-3xl font-bold text-white">Kelola Parkir</h2>
        </div>
        <a href="{{ route('petugas.parkir.masuk') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-lg shadow-blue-900/30 transition hover:bg-blue-500">
            <i class="fa-solid fa-plus mr-2"></i>
            Catat Kendaraan Masuk
        </a>
    </div>

    {{-- Ringkasan Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="rounded-2xl border border-blue-500/30 bg-[#071426] p-5 shadow-xl shadow-blue-950/40">
            <p class="text-sm text-blue-200/80">Kendaraan Masuk Hari Ini</p>
            <div class="mt-4 flex items-end justify-between">
                <h3 class="text-3xl font-bold text-white">{{ $transaksiHariIni }}</h3>
                <span class="rounded-full bg-blue-500/15 p-2 text-blue-300"><i class="fa-solid fa-ticket"></i></span>
            </div>
        </div>

        <div class="rounded-2xl border border-blue-500/30 bg-[#071426] p-5 shadow-xl shadow-blue-950/40">
            <p class="text-sm text-blue-200/80">Pendapatan Hari Ini</p>
            <div class="mt-4 flex items-end justify-between">
                <h3 class="text-3xl font-bold text-emerald-400">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
                <span class="rounded-full bg-emerald-500/15 p-2 text-emerald-300"><i class="fa-solid fa-wallet"></i></span>
            </div>
        </div>

        <div class="rounded-2xl border border-blue-500/30 bg-[#071426] p-5 shadow-xl shadow-blue-950/40">
            <p class="text-sm text-blue-200/80">Kendaraan Keluar Hari Ini</p>
            <div class="mt-4 flex items-end justify-between">
                <h3 class="text-3xl font-bold text-white">{{ $kendaraanKeluarHariIni }}</h3>
                <span class="rounded-full bg-cyan-500/15 p-2 text-cyan-300"><i class="fa-solid fa-car-side"></i></span>
            </div>
        </div>
    </div>

    {{-- Form Pencarian Global --}}
    <div class="bg-[#071426] p-4 rounded-xl border border-blue-500/30">
        <form action="{{ route('petugas.transaksi.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Plat Nomor ..." class="w-full rounded-lg border border-blue-500/30 bg-slate-900/80 px-4 py-2 text-sm text-white placeholder-slate-400 focus:border-blue-400 focus:outline-none">
            <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-500 transition">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('petugas.transaksi.index') }}" class="rounded-lg bg-slate-700 px-4 py-2 text-sm font-medium text-slate-200 hover:bg-slate-600 transition">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- TABEL 1: Kendaraan Masih Parkir (Aktif) --}}
    <div class="overflow-hidden rounded-2xl border border-amber-500/40 bg-[#071426] shadow-2xl shadow-amber-950/20">
        <div class="flex items-center justify-between border-b border-amber-500/20 bg-amber-500/10 px-5 py-4">
            <div class="flex items-center gap-2">
                <span class="h-3 w-3 rounded-full bg-amber-400 animate-pulse"></span>
                <h3 class="text-lg font-semibold text-amber-200">Kendaraan Masih Parkir (Aktif)</h3>
            </div>
            <span class="rounded-full bg-amber-500/20 px-3 py-1 text-xs font-semibold text-amber-300">
                {{ $transaksiMasuk->count() }} Kendaraan di Dalam
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-blue-100/90">
                <thead class="bg-blue-500/10 text-blue-100">
                    <tr>
                        <th class="px-5 py-3">No Tiket</th>
                        <th class="px-5 py-3">Plat Kendaraan</th>
                        <th class="px-5 py-3">Jenis / Area</th>
                        <th class="px-5 py-3">Waktu Masuk</th>
                        <th class="px-5 py-3">Petugas Input</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-500/10">
                    @forelse($transaksiMasuk as $item)
                    <tr class="hover:bg-amber-500/5 transition">
                        <td class="px-5 py-4 font-mono text-xs text-amber-300">#{{ $item->id_parkir }}</td>
                        <td class="px-5 py-4 font-bold text-white text-base">{{ $item->id_kendaraan }}</td>
                        <td class="px-5 py-4">
                            <span class="inline-block bg-blue-500/10 text-blue-200 px-2.5 py-1 rounded text-xs font-medium border border-blue-500/20">
                                {{ $item->tarif?->jenis_kendaraan ?? '-' }} / {{ $item->area?->nama_area ?? '-' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-blue-200">{{ $item->waktu_masuk }}</td>
                        <td class="px-5 py-4 text-slate-300">{{ $item->user?->nama_lengkap ?? $item->user?->nama ?? '-' }}</td>
                        <td class="px-5 py-4 text-center">
                            <a href="{{ route('petugas.parkir.keluar', ['keyword' => $item->id_parkir]) }}" 
                               class="inline-flex items-center rounded-lg bg-amber-500/20 border border-amber-500/40 px-3 py-1.5 text-xs font-bold text-amber-300 hover:bg-amber-500/40 transition">
                                <i class="fa-solid fa-right-from-bracket mr-1.5"></i> Proses Keluar
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-slate-400">Tidak ada kendaraan yang sedang parkir saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- TABEL 2: Riwayat Kendaraan Keluar (Selesai) --}}
    <div class="overflow-hidden rounded-2xl border border-blue-500/30 bg-[#071426] shadow-2xl shadow-blue-950/40">
        <div class="flex items-center justify-between border-b border-blue-500/20 bg-black/20 px-5 py-4">
            <h3 class="text-lg font-semibold text-white">Riwayat Parkir Keluar (Selesai)</h3>
            <span class="rounded-full border border-blue-500/30 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-200">
                Total Selesai: {{ $transaksiKeluar->total() }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-blue-100/90">
                <thead class="bg-blue-500/10 text-blue-100">
                    <tr>
                        <th class="px-5 py-3">No</th>
                        <th class="px-5 py-3">Plat</th>
                        <th class="px-5 py-3">Jenis</th>
                        <th class="px-5 py-3">Waktu Masuk</th>
                        <th class="px-5 py-3">Waktu Keluar</th>
                        <th class="px-5 py-3">Biaya Total</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-500/10">
                    @forelse($transaksiKeluar as $item)
                    <tr class="hover:bg-blue-500/5 transition">
                        <td class="px-5 py-4 text-slate-400">{{ $transaksiKeluar->firstItem() + $loop->index }}</td>
                        <td class="px-5 py-4 font-semibold text-white">{{ $item->id_kendaraan }}</td>
                        <td class="px-5 py-4 text-slate-300">{{ $item->tarif?->jenis_kendaraan ?? '-' }}</td>
                        <td class="px-5 py-4 text-slate-400 text-xs">{{ $item->waktu_masuk }}</td>
                        <td class="px-5 py-4 text-slate-300 text-xs">{{ $item->waktu_keluar }}</td>
                        <td class="px-5 py-4 text-emerald-400 font-bold">
                            Rp {{ number_format($item->biaya_total, 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            <a href="{{ route('petugas.struk.index', $item->id_parkir) }}" target="_blank" 
                               class="inline-flex items-center rounded-lg bg-blue-500/10 border border-blue-500/30 px-3 py-1.5 text-xs font-medium text-blue-200 hover:bg-blue-500/20 transition">
                                <i class="fa-solid fa-print mr-1.5"></i> Cetak Struk
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-slate-400">Belum ada riwayat transaksi selesai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Navigasi Pagination --}}
        @if($transaksiKeluar->hasPages())
        <div class="border-t border-blue-500/20 bg-black/10 px-5 py-3">
            {{ $transaksiKeluar->links() }}
        </div>
        @endif
    </div>
</div>
@endsection