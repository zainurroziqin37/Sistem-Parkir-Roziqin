@extends('layout.app')

@section('content')
<div class="space-y-6">

    {{-- Header & Tombol Action --}}
    <div class="flex justify-between items-center bg-[#071426] p-5 rounded-2xl shadow-xl shadow-blue-950/30 border border-blue-400/25">
        <div>
            <h1 class="text-2xl font-bold text-white">Laporan Transaksi Parkir</h1>
            <p class="text-blue-100 text-sm">Rekapitulasi data transaksi dan pendapatan parkir.</p>
        </div>
        <a href="{{ route('owner.laporan.cetak', request()->all()) }}" target="_blank" 
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2.5 rounded-lg font-medium transition shadow-sm">
            Cetak Laporan
        </a>
    </div>

    {{-- Form Filter Tanggal --}}
    <div class="bg-[#0a1b33] p-5 rounded-2xl shadow-xl shadow-blue-950/20 border border-blue-400/25">
        <form method="GET" action="{{ route('owner.laporan.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-blue-100 mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" 
                       class="w-full bg-[#071426] border border-blue-500/30 text-blue-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-100 mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" 
                       class="w-full bg-[#071426] border border-blue-500/30 text-blue-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg text-sm font-medium transition">
                    Filter
                </button>
                <a href="{{ route('owner.laporan.index') }}" class="w-full text-center bg-blue-500/15 hover:bg-blue-500/25 text-blue-100 py-2 rounded-lg text-sm font-medium transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Kartu Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-[#0a1b33] p-5 rounded-2xl shadow-xl shadow-blue-950/20 border border-blue-400/25">
            <p class="text-sm font-medium text-blue-100">Total Kendaraan Selesai</p>
            <h3 class="text-3xl font-bold text-white mt-1">{{ number_format($totalTransaksi) }} Kendaraan</h3>
        </div>
        <div class="bg-[#0a1b33] p-5 rounded-2xl shadow-xl shadow-blue-950/20 border border-blue-400/25">
            <p class="text-sm font-medium text-blue-100">Total Pendapatan</p>
            <h3 class="text-3xl font-bold text-emerald-400 mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="bg-[#071426] rounded-2xl shadow-2xl shadow-blue-950/40 border border-blue-500/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm text-blue-100/90">
                <thead class="bg-blue-500/10 text-blue-100">
                    <tr class="border-b border-blue-500/10 font-semibold">
                        <th class="p-4">No.</th>
                        <th class="p-4">Plat Kendaraan</th>
                        <th class="p-4">Jenis / Area</th>
                        <th class="p-4">Waktu Masuk</th>
                        <th class="p-4">Waktu Keluar</th>
                        <th class="p-4">Operator</th>
                        <th class="p-4 text-right">Biaya Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-500/10">
                    @forelse ($transaksis as $index => $item)
                        <tr class="hover:bg-blue-500/5 transition">
                            <td class="p-4 text-blue-200/70">{{ $transaksis->firstItem() + $index }}</td>
                            <td class="p-4 font-bold text-white">{{ $item->id_kendaraan }}</td>
                            <td class="p-4">
                                <span class="inline-block bg-blue-500/10 text-blue-200 px-2.5 py-1 rounded text-xs font-medium">
                                    {{ $item->tarif->jenis_kendaraan ?? '-' }} / {{ $item->area->nama_area ?? '-' }}
                                </span>
                            </td>
                            <td class="p-4 text-blue-100/80">{{ $item->waktu_masuk }}</td>
                            <td class="p-4 text-blue-100/80">{{ $item->waktu_keluar }}</td>
                            {{-- Pengecekan nama petugas yang aman --}}
                            <td class="p-4 text-blue-100/80">
                                {{ $item->user?->nama_lengkap ?? $item->user?->nama ?? '-' }}
                            </td>
                            <td class="p-4 font-semibold text-emerald-400 text-right">
                                Rp {{ number_format($item->biaya_total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-blue-200/70">Belum ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Navigasi Halaman --}}
        @if($transaksis->hasPages())
        <div class="p-4 border-t border-blue-500/10">
            {{ $transaksis->links() }}
        </div>
        @endif
    </div>

</div>
@endsection