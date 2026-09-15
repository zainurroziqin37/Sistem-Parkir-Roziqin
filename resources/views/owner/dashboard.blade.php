@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-blue-400/30 bg-gradient-to-r from-indigo-700/35 via-blue-900/30 to-[#071426] p-6 shadow-xl shadow-blue-950/30">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-200">Ringkasan bisnis</p>
        <h2 class="mt-2 text-3xl font-bold text-white">Dashboard Owner</h2>
        <p class="mt-2 text-blue-100">Pantau pendapatan dan performa operasional parkir secara ringkas.</p>
        <a href="{{ route('owner.laporan.index') }}" class="mt-5 inline-flex rounded-xl bg-blue-600 px-4 py-2.5 font-semibold text-white hover:bg-blue-500"><i class="fa-solid fa-file-invoice-dollar mr-2"></i>Buka laporan lengkap</a>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach([
            ['label' => 'Pendapatan hari ini', 'value' => 'Rp ' . number_format($pendapatanHariIni, 0, ',', '.'), 'icon' => 'fa-calendar-day'],
            ['label' => 'Pendapatan bulan ini', 'value' => 'Rp ' . number_format($pendapatanBulanIni, 0, ',', '.'), 'icon' => 'fa-chart-column'],
            ['label' => 'Total pendapatan', 'value' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'), 'icon' => 'fa-wallet'],
            ['label' => 'Kendaraan aktif', 'value' => $kendaraanAktif, 'icon' => 'fa-car-side'],
        ] as $card)
        <div class="rounded-2xl border border-blue-400/25 bg-[#0a1b33] p-5 shadow-lg shadow-blue-950/20"><div class="flex items-center justify-between"><p class="text-sm text-blue-100">{{ $card['label'] }}</p><span class="rounded-xl bg-blue-500/20 p-3 text-blue-300"><i class="fa-solid {{ $card['icon'] }}"></i></span></div><p class="mt-4 text-2xl font-bold text-white">{{ $card['value'] }}</p></div>
        @endforeach
    </div>
    <div class="rounded-2xl border border-blue-400/25 bg-[#071426] p-6"><h3 class="text-lg font-semibold text-white">Insight hari ini</h3><p class="mt-2 text-blue-100">Terdapat <strong class="text-white">{{ $totalTransaksi }}</strong> transaksi selesai dan <strong class="text-white">{{ $kendaraanAktif }}</strong> kendaraan yang masih berada di area parkir.</p></div>
</div>
@endsection
