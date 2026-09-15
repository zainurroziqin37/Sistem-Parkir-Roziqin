@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-sm uppercase tracking-[0.2em] text-blue-400 font-semibold">Monitoring</p>
            <h2 class="mt-2 text-3xl font-bold text-white">Log Aktivitas</h2>
        </div>
        <div class="inline-flex items-center gap-2 rounded-full border border-blue-500/40 bg-blue-500/10 px-4 py-2 text-sm text-blue-100 shadow-lg shadow-blue-900/20">
            <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
            Sistem aktif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="rounded-2xl border border-blue-500/30 bg-[#071426] p-5 shadow-xl shadow-blue-950/40">
            <p class="text-sm text-blue-200/80">Total aktivitas</p>
            <div class="mt-4 flex items-end justify-between">
                <h3 class="text-3xl font-bold text-white">{{ $totalAktivitas ?? 0 }}</h3>
                <span class="rounded-full bg-blue-500/15 p-2 text-blue-300"><i class="fa-solid fa-clipboard-list"></i></span>
            </div>
        </div>

        <div class="rounded-2xl border border-blue-500/30 bg-[#071426] p-5 shadow-xl shadow-blue-950/40">
            <p class="text-sm text-blue-200/80">Hari ini</p>
            <div class="mt-4 flex items-end justify-between">
                <h3 class="text-3xl font-bold text-white">{{ $aktivitasHariIni ?? 0 }}</h3>
                <span class="rounded-full bg-cyan-500/15 p-2 text-cyan-300"><i class="fa-solid fa-calendar-day"></i></span>
            </div>
        </div>

        <div class="rounded-2xl border border-blue-500/30 bg-[#071426] p-5 shadow-xl shadow-blue-950/40">
            <p class="text-sm text-blue-200/80">Aktivitas pengguna</p>
            <div class="mt-4 flex items-end justify-between">
                <h3 class="text-3xl font-bold text-white">{{ $aktivitasUser ?? 0 }}</h3>
                <span class="rounded-full bg-indigo-500/15 p-2 text-indigo-300"><i class="fa-solid fa-user-check"></i></span>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-blue-500/30 bg-[#071426] shadow-2xl shadow-blue-950/40">
        <div class="flex items-center justify-between border-b border-blue-500/20 bg-black/20 px-5 py-4">
            <h3 class="text-lg font-semibold text-white">Riwayat Aktivitas</h3>
            <span class="rounded-full border border-blue-500/30 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-200">
                {{ $logs->total() }} data
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-blue-500/20 text-left text-sm">
                <thead class="bg-blue-500/10 text-blue-100">
                    <tr>
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Pengguna</th>
                        <th class="px-5 py-3 font-semibold">Jenis</th>
                        <th class="px-5 py-3 font-semibold">Modul</th>
                        <th class="px-5 py-3 font-semibold">Keterangan</th>
                        <th class="px-5 py-3 font-semibold">Waktu</th>
                        <th class="px-5 py-3 font-semibold">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-500/10 text-blue-100/90">
                    @forelse ($logs as $log)
                        <tr class="transition hover:bg-blue-500/5">
                            <td class="px-5 py-4 font-medium text-blue-300">{{ $logs->firstItem() + $loop->index }}</td>
                            <td class="px-5 py-4">
                                <div class="font-medium text-white">{{ $log->user->nama_lengkap ?? 'System' }}</div>
                                <div class="text-xs text-blue-200/70">{{ $log->user->username ?? '-' }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="rounded-full border border-blue-400/30 bg-blue-500/10 px-2.5 py-1 text-xs font-medium text-blue-200">
                                    {{ $log->kategori ?? 'Aktivitas' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-blue-100/80">{{ $log->kategori ?? '-' }}</td>
                            <td class="px-5 py-4 max-w-xs text-blue-100/80">{{ $log->deskripsi ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-blue-100/80">
                                {{ $log->created_at ? $log->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-5 py-4 text-blue-100/80">{{ $log->ip_address ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-blue-200/80">
                                Belum ada data aktivitas yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($logs->hasPages())
            <div class="border-t border-blue-500/20 bg-black/20 px-5 py-4">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
