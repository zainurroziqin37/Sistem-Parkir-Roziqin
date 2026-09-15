@extends('layout.app')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Tambah Area Parkir</h2>
        <a href="{{ route('admin.area.index') }}" class="px-4 py-2 text-sm font-medium text-slate-300 bg-blue-500/10 border border-blue-500/20 rounded-lg hover:bg-blue-500/20">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-[#071426] border border-blue-500/20 rounded-2xl p-6 shadow-xl">
        <form action="{{ route('admin.area.store') }}" method="POST">
            @csrf
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-blue-300/80 mb-2">Nama Area / Blok</label>
                    <input type="text" name="nama_area" required class="w-full bg-black/20 border border-blue-500/20 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 placeholder-slate-500" placeholder="Contoh: Blok A VIP">
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-300/80 mb-2">Kapasitas Kendaraan</label>
                    <input type="number" name="kapasitas" required class="w-full bg-black/20 border border-blue-500/20 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 placeholder-slate-500" placeholder="Contoh: 50">
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-300/80 mb-2">Keterangan (Opsional)</label>
                    <textarea name="keterangan" rows="3" class="w-full bg-black/20 border border-blue-500/20 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 placeholder-slate-500" placeholder="Deskripsi area..."></textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="reset" class="px-5 py-2.5 text-sm font-medium text-slate-300 bg-red-500/10 border border-red-500/20 rounded-lg hover:bg-red-500/20">Reset</button>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500 shadow-[0_0_15px_rgba(37,99,235,0.4)]">
                    <i class="fa-solid fa-save mr-2"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection