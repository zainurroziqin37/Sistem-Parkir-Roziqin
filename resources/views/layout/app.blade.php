<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Parkir</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#030d1d] text-slate-200 antialiased font-sans {{ request()->routeIs('petugas.struk.index') || request()->routeIs('owner.laporan.cetak') ? 'print-receipt' : '' }}">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside class="w-72 bg-[#071426] border-r border-blue-500/20 flex flex-col shadow-2xl shadow-blue-950/50">
            <!-- Brand Logo -->
            <div class="flex items-center justify-center h-20 border-b border-blue-500/20 bg-black/10">
                <h1 class="text-2xl font-bold text-white tracking-wider flex items-center">
                    <i class="fa-solid fa-square-parking text-blue-500 mr-3 text-3xl"></i>E-PARKIR
                </h1>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                
                <p class="px-4 text-[11px] font-bold text-blue-300/50 uppercase tracking-wider mb-3">Menu Utama</p>
                <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" 
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('*.dashboard') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                    <i class="fa-solid fa-chart-pie w-7"></i> Dashboard
                </a>

                <!-- ADMIN -->
                @if(strtolower(Auth::user()->role) === 'admin')
                    <div class="pt-6 pb-2">
                        <p class="px-4 text-[11px] font-bold text-blue-300/50 uppercase tracking-wider">Kelola Data (Admin)</p>
                    </div>
                    
                    <a href="{{ route('admin.user.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.user.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-users w-7"></i> CRUD User
                    </a>
                    <a href="{{ route('admin.tarif.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.tarif.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-money-bill-wave w-7"></i> CRUD Tarif Parkir
                    </a>
                   <a href="{{ route('admin.area.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.area.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-map-location-dot w-7"></i> CRUD Area Parkir
                    </a>
                    <a href="{{ route('admin.kendaraan.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.kendaraan.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-car w-7"></i> CRUD Kendaraan
                    </a>
                    <a href="{{ route('admin.log.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.log.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-clipboard-list w-7"></i> Log Aktivitas
                    </a>
                @endif

                <!-- PETUGAS -->
                @if(strtolower(Auth::user()->role) === 'petugas')
                    <div class="pt-6 pb-2">
                        <p class="px-4 text-[11px] font-bold text-blue-300/50 uppercase tracking-wider">Operasional (Petugas)</p>
                    </div>
                    
                    <a href="{{ route('petugas.transaksi.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('petugas.transaksi.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-right-to-bracket w-7"></i> Transaksi Parkir
                    </a>
                    <a href="{{ route('petugas.transaksi.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('petugas.struk.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-print w-7"></i> Cetak Struk Parkir
                    </a>
                @endif

                <!-- OWNER -->
                @if(strtolower(Auth::user()->role) === 'owner')
                    <div class="pt-6 pb-2">
                        <p class="px-4 text-[11px] font-bold text-blue-300/50 uppercase tracking-wider">Laporan (Owner)</p>
                    </div>
                    
                    <a href="{{ route('owner.laporan.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('owner.laporan.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-file-invoice-dollar w-7"></i> Rekap Transaksi
                    </a>
                @endif

            </nav>                
               <!-- User Profile & Logout Box -->
            <div class="p-4 bg-black/20 border-t border-blue-500/20">
                <div class="flex items-center gap-3 mb-4 px-2">
                    <div class="h-10 w-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 font-bold border border-blue-500/30">
                        {{ substr(Auth::user()->nama_lengkap ?? Auth::user()->username ?? 'U', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->nama_lengkap ?? Auth::user()->username ?? 'User Name' }}</p>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"></span>
                            <p class="text-xs text-blue-300/70 capitalize">{{ Auth::user()->role ?? 'Role' }}</p>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" data-confirm="Apakah Anda yakin ingin logout dari akun ini?">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-lg bg-red-500/10 border border-red-500/20 px-4 py-2.5 text-sm font-bold text-red-400 transition-all hover:bg-red-500 hover:text-white hover:shadow-lg hover:shadow-red-500/30">
                        <i class="fa-solid fa-power-off"></i> Logout Sistem
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Ornamen Dekorasi Background -->
            <div class="absolute top-0 left-0 w-full h-96 bg-blue-600/5 blur-[120px] pointer-events-none"></div>

            <!-- Top Header -->
            <header class="h-20 border-b border-blue-500/20 bg-[#071426]/60 backdrop-blur-md flex items-center justify-between px-8 z-10">
                <h2 class="text-xl font-bold text-white truncate">Sistem Manajemen Parkir Terpadu</h2>
                <div class="flex items-center gap-4 text-sm font-medium text-blue-200/80 bg-blue-500/10 border border-blue-500/20 px-4 py-2 rounded-full">
                    <i class="fa-regular fa-clock text-blue-400"></i>
                    <span>{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                </div>
            </header>

            <!-- Halaman Dinamis -->
            <div class="flex-1 overflow-y-auto p-8 z-10 custom-scrollbar">
                @yield('content')
            </div>

            <footer class="border-t border-blue-500/20 bg-[#071426]/80 px-8 py-4 text-center text-sm text-blue-100 print:hidden">
                <p>&copy; {{ now()->year }} E-PARKIR. Sistem Manajemen Parkir Terpadu.</p>
                <p class="mt-1 text-xs text-blue-200">Dikelola dengan aman dan efisien.</p>
            </footer>
        </main>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(59, 130, 246, 0.4); }

        @media print {
            body.print-receipt { background: #fff !important; }
            body.print-receipt .print\:hidden { display: none !important; }
            body.print-receipt > div > aside,
            body.print-receipt > div > main > header,
            body.print-receipt > div > main > div:first-child {
                display: none !important;
            }
            body.print-receipt > div,
            body.print-receipt > div > main,
            body.print-receipt > div > main > div {
                display: block !important;
                width: 100% !important;
                height: auto !important;
                min-height: 0 !important;
                overflow: visible !important;
                padding: 0 !important;
            }
            body.print-receipt .max-w-md {
                max-width: 420px !important;
                margin: 0 auto !important;
            }
            body.print-receipt .max-w-4xl {
                max-width: 100% !important;
                margin: 0 auto !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swalTheme = {
                background: '#071426',
                color: '#e2e8f0',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#475569',
                buttonsStyling: true
            };

            document.querySelectorAll('form[data-confirm]').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.dataset.confirmed === 'true') {
                        return;
                    }

                    event.preventDefault();

                    Swal.fire({
                        ...swalTheme,
                        icon: 'warning',
                        iconColor: '#60a5fa',
                        title: 'Konfirmasi tindakan',
                        text: form.dataset.confirm,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, lanjutkan',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            form.dataset.confirmed = 'true';
                            form.submit();
                        }
                    });
                });
            });

            @if (session('success'))
                Swal.fire({
                    ...swalTheme,
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('success')),
                    timer: 2600,
                    showConfirmButton: false
                });
            @elseif (session('error'))
                Swal.fire({
                    ...swalTheme,
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: @json(session('error')),
                    confirmButtonText: 'Tutup'
                });
            @elseif ($errors->any())
                Swal.fire({
                    ...swalTheme,
                    icon: 'error',
                    title: 'Periksa kembali',
                    text: @json($errors->first()),
                    confirmButtonText: 'Tutup'
                });
            @endif
        });
    </script>
</body>
</html>