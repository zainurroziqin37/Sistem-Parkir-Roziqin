@extends('layout.app')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    {{-- Header --}}
    <div>
        <h2 class="text-2xl font-bold text-white">Kendaraan Masuk</h2>
        <p class="text-sm text-blue-200/80 mt-1">Input plat nomor untuk cetak tiket parkir baru.</p>
    </div>

    {{-- Alert Success --}}
    {{-- Form Container --}}
    <div class="bg-[#071426] rounded-2xl shadow-2xl shadow-blue-950/40 border border-blue-500/30 p-6">
        <form action="{{ route('petugas.parkir.storeMasuk') }}" method="POST" class="space-y-5">
            @csrf
            
            {{-- Input Plat Nomor --}}
            <div>
                <label class="block text-sm font-semibold text-blue-100 mb-2">Plat Nomor Kendaraan</label>
                <input type="text" 
                       name="plat_nomor" 
                       list="kendaraan-terdaftar" 
                       placeholder="Contoh: B 1234 ABC" 
                       autofocus 
                       required
                       class="w-full px-4 py-3 text-xl font-bold border border-blue-500/30 rounded-xl uppercase bg-[#0a1b33] text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                
                <datalist id="kendaraan-terdaftar">
                    @foreach($kendaraans as $kendaraan)
                        <option value="{{ $kendaraan->plat_nomor }}">{{ ucfirst($kendaraan->jenis_kendaraan) }} - {{ $kendaraan->pemilik }}</option>
                    @endforeach
                </datalist>
            </div>

            {{-- Select Jenis Kendaraan --}}
            <div>
                <label class="block text-sm font-semibold text-blue-100 mb-2">Jenis Kendaraan & Tarif</label>
                <select name="id_tarif" required class="w-full px-4 py-3 border border-blue-500/30 rounded-xl bg-[#0a1b33] text-white font-medium focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="" disabled selected class="bg-[#0a1b33] text-slate-400">-- Pilih Jenis Kendaraan & Tarif --</option>
                    @foreach($tarifs as $tarif)
                        <option value="{{ $tarif->id_tarif }}" class="bg-[#0a1b33] text-white">
                            {{ $tarif->jenis_kendaraan }} — Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}/jam
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Select Area Parkir --}}
            <div>
                <label class="block text-sm font-semibold text-blue-100 mb-2">Pilih Area Parkir</label>
                <select name="id_area" required class="w-full px-4 py-3 border border-blue-500/30 rounded-xl bg-[#0a1b33] text-white font-medium focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="" disabled selected class="bg-[#0a1b33] text-slate-400">-- Pilih Area Parkir --</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id_area }}" class="bg-[#0a1b33] text-white">
                            {{ $area->nama_area }} (Terisi: {{ $area->terisi ?? 0 }}/{{ $area->kapasitas }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-blue-600/30 transition flex justify-center items-center gap-2">
                <i class="fa-solid fa-ticket"></i>
                <span>Cetak Tiket Parkir</span>
            </button>
        </form>
    </div>
</div>
@endsection