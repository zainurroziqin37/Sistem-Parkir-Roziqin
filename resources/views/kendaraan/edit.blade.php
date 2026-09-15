@extends('layout.app')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-white">Edit Kendaraan</h2>
        <a href="{{ route('admin.kendaraan.index') }}" class="text-sm font-medium text-blue-100 hover:text-white">
            <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="rounded-2xl border border-blue-500/25 bg-[#071426] p-6 shadow-xl shadow-blue-950/30">
        <form action="{{ route('admin.kendaraan.update', $kendaraan->id_kendaraan) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="mb-1 block text-sm font-medium text-blue-100">Plat Nomor</label>
                <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}" required class="w-full rounded-lg border border-blue-400/25 bg-[#0b1d36] px-4 py-2 text-white uppercase focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-blue-100">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required class="w-full rounded-lg border border-blue-400/25 bg-[#0b1d36] px-4 py-2 text-white focus:border-blue-400 focus:outline-none">
                    <option value="">Pilih jenis kendaraan</option>
                    @foreach($jenisKendaraan as $jenis)
                        <option value="{{ $jenis }}" @selected(old('jenis_kendaraan', $kendaraan->jenis_kendaraan) === $jenis)>{{ ucfirst($jenis) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-blue-100">Warna</label>
                <input type="text" name="warna" value="{{ old('warna', $kendaraan->warna) }}" required class="w-full rounded-lg border border-blue-400/25 bg-[#0b1d36] px-4 py-2 text-white focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-blue-100">Nama Pemilik</label>
                <input type="text" name="pemilik" value="{{ old('pemilik', $kendaraan->pemilik) }}" required class="w-full rounded-lg border border-blue-400/25 bg-[#0b1d36] px-4 py-2 text-white focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
            </div>
            <div class="flex justify-end pt-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
