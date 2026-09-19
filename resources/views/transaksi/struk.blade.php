@extends('layout.app')

@section('content')
<div class="mx-auto max-w-md">
    <div class="mb-6 flex items-center justify-between print:hidden">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-blue-400 font-semibold">Transaksi</p>
            <h2 class="mt-2 text-2xl font-bold text-white">Struk Parkir</h2>
        </div>
        <a href="{{ route('petugas.transaksi.index') }}" class="rounded-lg bg-slate-800 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700">
            Kembali
        </a>
    </div>

    <div class="rounded-2xl bg-white p-6 text-slate-800 shadow-xl print:rounded-none print:shadow-none">
        <div class="border-b border-dashed border-slate-300 pb-4 text-center">
            <h1 class="text-xl font-bold">PARKIR ROZIQIN</h1>
            <p class="text-sm text-slate-500">Bukti pembayaran parkir</p>
            <p class="mt-2 text-xs text-slate-500">Tiket #{{ $transaksi->id_parkir }}</p>
        </div>

        <div class="space-y-3 py-5 text-sm">
            <div class="flex justify-between gap-4">
                <span class="text-slate-500">Plat nomor</span>
                <strong>{{ $transaksi->id_kendaraan }}</strong>
            </div>
            <div class="flex justify-between gap-4">
                <span class="text-slate-500">Jenis kendaraan</span>
                <span>{{ $transaksi->tarif?->jenis_kendaraan ?? '-' }}</span>
            </div>
            <div class="flex justify-between gap-4">
                <span class="text-slate-500">Area</span>
                <span>{{ $transaksi->area?->nama_area ?? '-' }}</span>
            </div>
            <div class="flex justify-between gap-4">
                <span class="text-slate-500">Waktu masuk</span>
                <span>{{ $transaksi->waktu_masuk }}</span>
            </div>
            <div class="flex justify-between gap-4">
                <span class="text-slate-500">Waktu keluar</span>
                <span>{{ $transaksi->waktu_keluar }}</span>
            </div>
            <div class="flex justify-between gap-4">
                <span class="text-slate-500">Durasi</span>
                <span>{{ $transaksi->durasi_jam }} jam</span>
            </div>
        </div>

        <div class="border-t border-dashed border-slate-300 pt-4">
            <div class="flex items-center justify-between">
                <span class="font-semibold">Total pembayaran</span>
                <strong class="text-2xl text-emerald-600">Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="mt-6 border-t border-dashed border-slate-300 pt-4 text-center text-xs text-slate-500">
            <p class="uppercase tracking-wider">Pemilik / Owner</p>
            <p class="mt-1 font-semibold text-slate-700">
                {{ $owner?->nama_lengkap ?: $owner?->username ?: '-' }}
            </p>
        </div>

        <p class="mt-6 text-center text-xs text-slate-500">Terima kasih telah menggunakan layanan kami.</p>
    </div>

    <div class="mt-4 flex gap-3 print:hidden">
        <button type="button" onclick="window.print()" class="flex-1 rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white hover:bg-blue-700">
            <i class="fa-solid fa-print mr-2"></i>Cetak Struk
        </button>
        <a href="{{ route('petugas.parkir.masuk') }}" class="rounded-lg bg-emerald-600 px-4 py-3 font-semibold text-white hover:bg-emerald-700">
            Parkir Masuk
        </a>
    </div>
</div>
@endsection
