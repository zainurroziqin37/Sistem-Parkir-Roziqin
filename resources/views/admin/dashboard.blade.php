@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-blue-400/30 bg-gradient-to-r from-blue-700/40 via-blue-900/30 to-[#071426] p-6 shadow-xl shadow-blue-950/30">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-200">Pusat kendali administrator</p>
        <h2 class="mt-2 text-3xl font-bold text-white">Selamat datang, {{ Auth::user()->nama_lengkap }}</h2>
        <p class="mt-2 max-w-2xl text-blue-100">Pantau operasional parkir, kelola data master, dan pastikan sistem berjalan dengan baik hari ini.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach([
            ['label' => 'Pendapatan hari ini', 'value' => 'Rp ' . number_format($pendapatanHariIni, 0, ',', '.'), 'icon' => 'fa-wallet'],
            ['label' => 'Total pendapatan', 'value' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'), 'icon' => 'fa-chart-line'],
            ['label' => 'Kendaraan aktif', 'value' => $kendaraanAktif, 'icon' => 'fa-car-side'],
            ['label' => 'Total petugas', 'value' => $totalPetugas, 'icon' => 'fa-user-shield'],
        ] as $card)
        <div class="rounded-2xl border border-blue-400/25 bg-[#0a1b33] p-5 shadow-lg shadow-blue-950/20">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-blue-100">{{ $card['label'] }}</p>
                <span class="rounded-xl bg-blue-500/20 p-3 text-blue-300"><i class="fa-solid {{ $card['icon'] }}"></i></span>
            </div>
            <p class="mt-4 text-2xl font-bold text-white">{{ $card['value'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.5fr_1fr]">
        <div class="overflow-hidden rounded-2xl border border-blue-400/25 bg-[#071426]">
            <div class="flex items-center justify-between border-b border-blue-400/20 px-5 py-4">
                <h3 class="font-semibold text-white">Transaksi terbaru</h3>
                <a href="{{ route('admin.log.index') }}" class="text-sm font-medium text-blue-300 hover:text-white">Lihat log</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-blue-100">
                    <thead class="bg-blue-600/20 text-xs uppercase text-blue-200"><tr><th class="px-5 py-3">Kendaraan</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Waktu</th></tr></thead>
                    <tbody class="divide-y divide-blue-400/10">
                    @forelse($transaksiTerbaru as $transaksi)
                        <tr class="hover:bg-blue-500/10"><td class="px-5 py-4 font-semibold text-white">{{ $transaksi->id_kendaraan }}</td><td class="px-5 py-4">{{ ucfirst($transaksi->status) }}</td><td class="px-5 py-4 text-blue-200">{{ $transaksi->waktu_masuk }}</td></tr>
                    @empty
                        <tr><td colspan="3" class="px-5 py-6 text-center text-blue-200">Belum ada transaksi.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="rounded-2xl border border-blue-400/25 bg-[#071426] p-5">
            <h3 class="font-semibold text-white">Akses cepat</h3>
            <div class="mt-4 grid gap-3">
                <a href="{{ route('admin.user.create') }}" class="rounded-xl border border-blue-400/20 bg-blue-500/10 p-4 text-blue-100 hover:bg-blue-500/20"><i class="fa-solid fa-user-plus mr-2 text-blue-300"></i>Tambah user baru</a>
                <a href="{{ route('admin.tarif.create') }}" class="rounded-xl border border-blue-400/20 bg-blue-500/10 p-4 text-blue-100 hover:bg-blue-500/20"><i class="fa-solid fa-money-bill-wave mr-2 text-blue-300"></i>Atur tarif parkir</a>
                <a href="{{ route('admin.area.create') }}" class="rounded-xl border border-blue-400/20 bg-blue-500/10 p-4 text-blue-100 hover:bg-blue-500/20"><i class="fa-solid fa-map-location-dot mr-2 text-blue-300"></i>Tambah area parkir</a>
            </div>
        </div>
    </div>
</div>
@endsection
