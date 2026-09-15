@extends('layout.app')

@section('content')
<div class="mx-auto max-w-4xl">
    <div class="mb-6 flex items-center justify-between print:hidden">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-blue-400 font-semibold">Owner / Laporan</p>
            <h2 class="mt-2 text-2xl font-bold text-white">Cetak Laporan Parkir</h2>
        </div>
        <a href="{{ route('owner.laporan.index', request()->all()) }}" class="rounded-lg bg-slate-800 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700">
            Kembali
        </a>
    </div>

    <div class="rounded-2xl bg-white p-6 text-slate-800 shadow-xl print:rounded-none print:shadow-none">
        <div class="border-b border-dashed border-slate-300 pb-4 text-center">
            <h1 class="text-xl font-bold">PARKIR ROZIQIN</h1>
            <p class="text-sm text-slate-500">Rekapitulasi Transaksi & Pendapatan Parkir</p>
            <p class="mt-2 text-xs text-slate-400">
                Dicetak pada: {{ date('d-m-Y H:i') }}
                @if(request('tanggal_mulai') || request('tanggal_selesai'))
                    | Periode: {{ request('tanggal_mulai') ?? 'Awal' }} s/d {{ request('tanggal_selesai') ?? 'Sekarang' }}
                @endif
            </p>
        </div>

        <div class="my-5 grid grid-cols-2 gap-4 rounded-xl bg-slate-50 p-4 text-sm print:border-none print:bg-transparent print:p-0">
            <div>
                <span class="text-slate-500 block">Total Transaksi Selesai</span>
                <strong class="text-xl text-slate-800">{{ number_format($totalTransaksi) }} Kendaraan</strong>
            </div>
            <div class="text-right">
                <span class="text-slate-500 block">Total Pendapatan</span>
                <strong class="text-2xl text-emerald-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="py-2">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b-2 border-slate-800 text-slate-800 font-bold">
                        <th class="py-2">No.</th>
                        <th class="py-2">Plat Nomor</th>
                        <th class="py-2">Jenis / Area</th>
                        <th class="py-2">Waktu Masuk</th>
                        <th class="py-2">Waktu Keluar</th>
                        <th class="py-2">Petugas</th>
                        <th class="py-2 text-right">Biaya Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($transaksis as $item)
                        <tr>
                            <td class="py-2 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="py-2 font-bold text-slate-700">{{ $item->id_kendaraan }}</td>
                            <td class="py-2">
                                {{ $item->tarif?->jenis_kendaraan ?? '-' }} / {{ $item->area?->nama_area ?? '-' }}
                            </td>
                            <td class="py-2 text-slate-600">{{ $item->waktu_masuk }}</td>
                            <td class="py-2 text-slate-600">{{ $item->waktu_keluar }}</td>
                            <td class="py-2 text-slate-600">{{ $item->user?->nama ?? '-' }}</td>
                            <td class="py-2 font-semibold text-emerald-600 text-right">
                                Rp {{ number_format($item->biaya_total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-slate-400">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-10 pt-6 flex justify-end text-sm">
            <div class="text-center w-48">
                <p class="text-slate-600">Pemilik / Owner,</p>
                <div class="h-16"></div>
                <p class="font-bold border-b border-slate-800 pb-1">( Manager Parkir )</p>
            </div>
        </div>

        <p class="mt-6 text-center text-xs text-slate-400 border-t border-dashed border-slate-200 pt-4">
            Dokumen resmi sistem Parkir Roziqin.
        </p>
    </div>

    <div class="mt-4 flex gap-3 print:hidden">
        <button type="button" onclick="window.print()" class="flex-1 rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white hover:bg-blue-700">
            <i class="fa-solid fa-print mr-2"></i>Cetak Laporan
        </button>
        <a href="{{ route('owner.laporan.index', request()->all()) }}" class="rounded-lg bg-slate-700 px-6 py-3 font-semibold text-white hover:bg-slate-600">
            Kembali
        </a>
    </div>
</div>
@endsection