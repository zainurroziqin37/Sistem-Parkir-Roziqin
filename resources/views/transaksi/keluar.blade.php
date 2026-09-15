@extends('layout.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Header --}}
    <div>
        <h2 class="text-2xl font-bold text-white">Kendaraan Keluar</h2>
        <p class="text-sm text-blue-200/80 mt-1">Cari nomor tiket atau plat nomor untuk memproses pembayaran parkir.</p>
    </div>

    {{-- Form Pencarian Tiket / Plat Nomor --}}
    <div class="bg-[#071426] rounded-2xl shadow-2xl shadow-blue-950/40 border border-blue-500/30 p-6">
        <form action="{{ route('petugas.parkir.keluar') }}" method="GET" class="space-y-4">
            <label class="block text-sm font-semibold text-blue-100">Masukkan ID Tiket atau Plat Nomor</label>
            <div class="flex gap-2">
                <input type="text" 
                       name="keyword" 
                       value="{{ request('keyword') }}" 
                       placeholder="Contoh: #12 atau AG 1234 CD" 
                       autofocus 
                       required
                       class="w-full px-4 py-3 text-lg font-bold border border-blue-500/30 rounded-xl uppercase bg-[#0a1b33] text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-xl transition shadow-lg shadow-blue-600/30 flex items-center gap-2 shrink-0">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Cari</span>
                </button>
            </div>
        </form>
    </div>

    {{-- Detail Transaksi (Jika Data Ditemukan) --}}
    @if(isset($transaksi))
    <div class="bg-[#071426] rounded-2xl shadow-2xl shadow-blue-950/40 border border-blue-500/30 overflow-hidden">
        <div class="bg-blue-500/10 border-b border-blue-500/20 px-6 py-4 flex justify-between items-center">
            <h3 class="text-lg font-bold text-white">Detail Pembayaran Parkir</h3>
            <span class="font-mono text-xs text-amber-300 font-semibold bg-amber-500/20 border border-amber-500/30 px-3 py-1 rounded-full">
                ID Tiket: #{{ $transaksi->id_parkir }}
            </span>
        </div>

        <form action="{{ route('petugas.parkir.storeKeluar', $transaksi->id_parkir) }}" method="POST" class="p-6 space-y-6">
            @csrf

            {{-- Ringkasan Data Kendaraan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-[#0a1b33] p-4 rounded-xl border border-blue-500/20">
                    <p class="text-xs text-blue-200/70 font-medium">Plat Nomor Kendaraan</p>
                    <p class="text-2xl font-extrabold text-white uppercase mt-1">{{ $transaksi->id_kendaraan }}</p>
                </div>

                <div class="bg-[#0a1b33] p-4 rounded-xl border border-blue-500/20">
                    <p class="text-xs text-blue-200/70 font-medium">Jenis Kendaraan / Area</p>
                    <p class="text-lg font-bold text-blue-100 mt-1">
                        {{ $transaksi->tarif?->jenis_kendaraan ?? '-' }} ({{ $transaksi->area?->nama_area ?? '-' }})
                    </p>
                </div>

                <div class="bg-[#0a1b33] p-4 rounded-xl border border-blue-500/20">
                    <p class="text-xs text-blue-200/70 font-medium">Waktu Masuk</p>
                    <p class="text-base font-semibold text-slate-200 mt-1">{{ $transaksi->waktu_masuk }}</p>
                </div>

                <div class="bg-[#0a1b33] p-4 rounded-xl border border-blue-500/20">
                    <p class="text-xs text-blue-200/70 font-medium">Waktu Keluar (Estimasi)</p>
                    <p class="text-base font-semibold text-slate-200 mt-1">{{ $waktuKeluar ?? now()->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>

            {{-- Box Total Biaya --}}
            <div class="bg-gradient-to-br from-[#0a1b33] to-[#0d2342] p-6 rounded-xl border border-emerald-500/30 flex justify-between items-center shadow-inner">
                <div>
                    <p class="text-xs text-emerald-300 font-semibold uppercase tracking-wider">Total Biaya Parkir</p>
                    <p class="text-xs text-slate-400 mt-0.5">Durasi: {{ $durasiJam ?? 1 }} Jam</p>
                </div>
                <div class="text-right">
                <p class="text-2xl font-bold">
                    Rp {{ number_format($transaksi->biaya_hitung ?? 0, 0, ',', '.') }}
                </p>                
            </div>
            </div>

            {{-- Tombol Konfirmasi Selesai --}}
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-emerald-600/20 transition flex justify-center items-center gap-2">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Proses Bayar & Cetak Struk</span>
            </button>
        </form>
    </div>
    @endif

</div>
@endsection