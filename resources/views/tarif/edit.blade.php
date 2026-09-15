@extends('layout.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-blue-400 font-semibold">Master Tarif</p>
            <h2 class="mt-1 text-3xl font-bold text-white">Edit Tarif Parkir</h2>
        </div>
        <a href="{{ route('admin.tarif.index') }}" class="inline-flex items-center rounded-xl bg-slate-800 px-4 py-2.5 text-sm font-medium text-slate-300 border border-slate-700 transition hover:bg-slate-700 hover:text-white">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <div class="rounded-2xl border border-blue-500/20 bg-[#071426] p-6 shadow-2xl shadow-blue-950/40">
        <form action="{{ route('admin.tarif.update', $tarif->id_tarif) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Input Jenis Kendaraan -->
            <div>
                <label for="jenis_kendaraan" class="block text-sm font-medium text-slate-300 mb-2">Jenis Kendaraan</label>
                <input type="text" name="jenis_kendaraan" id="jenis_kendaraan" value="{{ old('jenis_kendaraan', $tarif->jenis_kendaraan) }}" required
                    class="w-full rounded-xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition">
                @error('jenis_kendaraan')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Tarif per Jam -->
            <div>
                <label for="tarif_per_jam" class="block text-sm font-medium text-slate-300 mb-2">Tarif per Jam (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-medium">Rp</span>
                    <input type="number" name="tarif_per_jam" id="tarif_per_jam" value="{{ old('tarif_per_jam', $tarif->tarif_per_jam) }}" required min="0"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900/80 pl-12 pr-4 py-3 text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition">
                </div>
                @error('tarif_per_jam')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-800">
                <a href="{{ route('admin.tarif.index') }}" class="rounded-xl px-5 py-2.5 text-sm font-medium text-slate-400 hover:text-white transition">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-medium text-white shadow-lg shadow-blue-900/30 transition hover:bg-blue-500">
                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                    Update Tarif
                </button>
            </div>
        </form>
    </div>
</div>
@endsection