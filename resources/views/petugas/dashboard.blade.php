@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-blue-400/30 bg-gradient-to-r from-cyan-700/30 via-blue-900/30 to-[#071426] p-6 shadow-xl shadow-blue-950/30">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-200">Panel operasional</p>
        <h2 class="mt-2 text-3xl font-bold text-white">Dashboard Petugas</h2>
        <p class="mt-2 text-blue-100">Kelola kendaraan masuk, pembayaran keluar, dan cetak struk dengan cepat.</p>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ route('petugas.parkir.masuk') }}" class="rounded-xl bg-blue-600 px-4 py-2.5 font-semibold text-white hover:bg-blue-500"><i class="fa-solid fa-ticket mr-2"></i>Catat kendaraan masuk</a>
            <a href="{{ route('petugas.parkir.keluar') }}" class="rounded-xl border border-blue-300/30 bg-blue-500/10 px-4 py-2.5 font-semibold text-blue-100 hover:bg-blue-500/20"><i class="fa-solid fa-right-from-bracket mr-2"></i>Proses kendaraan keluar</a>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach([
            ['label' => 'Kendaraan aktif', 'value' => $kendaraanAktif, 'icon' => 'fa-car-side'],
            ['label' => 'Transaksi hari ini', 'value' => $transaksiHariIni, 'icon' => 'fa-ticket'],
            ['label' => 'Selesai dibayar', 'value' => $transaksiSelesai, 'icon' => 'fa-circle-check'],
            ['label' => 'Pendapatan hari ini', 'value' => 'Rp ' . number_format($pendapatanHariIni, 0, ',', '.'), 'icon' => 'fa-wallet'],
        ] as $card)
        <div class="rounded-2xl border border-blue-400/25 bg-[#0a1b33] p-5 shadow-lg shadow-blue-950/20"><div class="flex items-center justify-between"><p class="text-sm text-blue-100">{{ $card['label'] }}</p><span class="rounded-xl bg-blue-500/20 p-3 text-blue-300"><i class="fa-solid {{ $card['icon'] }}"></i></span></div><p class="mt-4 text-2xl font-bold text-white">{{ $card['value'] }}</p></div>
        @endforeach
    </div>
</div>
@endsection
