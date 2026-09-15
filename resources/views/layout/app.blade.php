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
    
    <div id="app-shell" class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside id="app-sidebar" class="fixed inset-y-0 left-0 z-40 flex w-72 -translate-x-full flex-col bg-[#071426] border-r border-blue-500/20 shadow-2xl shadow-blue-950/50 transition-[transform,width] duration-300 ease-in-out md:relative md:translate-x-0">
            <div id="sidebar-resizer" role="separator" aria-label="Ubah lebar sidebar" tabindex="0"></div>
            <!-- Brand Logo -->
<!-- Brand Logo -->
<div class="relative flex items-center justify-center h-20 overflow-hidden
            border-b border-blue-500/20 bg-[#061222]">

    <!-- Glow Background -->
    <div class="absolute inset-0 bg-gradient-to-r
                from-transparent via-blue-600/10 to-transparent">
    </div>

    <!-- Decorative Line -->
    <div class="absolute bottom-0 left-0 h-[2px] w-full
                bg-gradient-to-r from-transparent via-blue-500 to-transparent">
    </div>

    <div class="relative flex w-full items-center justify-between gap-2 px-4">
        <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" aria-label="Kembali ke dashboard" class="flex items-center gap-3 group">

        <!-- Icon -->
        <div class="relative">
            <!-- Glow -->
            <div class="absolute -inset-1 rounded-xl bg-blue-500/30
                        blur-md opacity-70 transition-all duration-300
                        group-hover:opacity-100 group-hover:blur-lg">
            </div>

            <!-- Box -->
            <div class="relative flex h-11 w-11 items-center justify-center
                        rounded-xl bg-blue-600
                        border border-blue-400/50
                        shadow-[0_0_20px_rgba(37,99,235,0.35)]
                        transition-all duration-300
                        group-hover:-translate-y-1
                        group-hover:shadow-[0_0_30px_rgba(37,99,235,0.6)]">

                <i class="fa-solid fa-square-parking
                          text-xl text-white
                          drop-shadow-[0_2px_3px_rgba(0,0,0,0.5)]">
                </i>
            </div>
        </div>

        <!-- Brand Text -->
        <div class="sidebar-label flex flex-col">

            <div class="flex items-baseline leading-none">
                <span class="text-2xl font-black italic tracking-tighter
                             text-white">
                    RZ
                </span>

                <span class="text-2xl font-black italic tracking-tighter
                             text-blue-500">
                    PARK
                </span>
            </div>

            <!-- Subtitle -->
            <div class="mt-1 flex items-center gap-1.5">
                <span class="h-[2px] w-5 bg-blue-500"></span>

                <span class="text-[8px] font-bold uppercase
                             tracking-[0.28em] text-blue-300/70">
                    Management System
                </span>
            </div>

        </div>
        </a>
    </div>
</div>
            <!-- Menu Navigasi -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                
                <p class="sidebar-label px-4 text-[11px] font-bold text-blue-300/50 uppercase tracking-wider mb-3">Menu Utama</p>
                <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" 
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('*.dashboard') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                    <i class="fa-solid fa-chart-pie w-7 shrink-0"></i><span class="sidebar-label">Dashboard</span>
                </a>

                <!-- ADMIN -->
                @if(strtolower(Auth::user()->role) === 'admin')
                    <div class="pt-6 pb-2">
                        <p class="sidebar-label px-4 text-[11px] font-bold text-blue-300/50 uppercase tracking-wider">Kelola Data (Admin)</p>
                    </div>
                    
                    <a href="{{ route('admin.user.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.user.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-users w-7 shrink-0"></i><span class="sidebar-label">CRUD User</span>
                    </a>
                    <a href="{{ route('admin.tarif.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.tarif.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-money-bill-wave w-7 shrink-0"></i><span class="sidebar-label">CRUD Tarif Parkir</span>
                    </a>
                   <a href="{{ route('admin.area.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.area.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-map-location-dot w-7 shrink-0"></i><span class="sidebar-label">CRUD Area Parkir</span>
                    </a>
                    <a href="{{ route('admin.kendaraan.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.kendaraan.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-car w-7 shrink-0"></i><span class="sidebar-label">CRUD Kendaraan</span>
                    </a>
                    <a href="{{ route('admin.log.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('admin.log.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-clipboard-list w-7 shrink-0"></i><span class="sidebar-label">Log Aktivitas</span>
                    </a>
                @endif

                <!-- PETUGAS -->
                @if(strtolower(Auth::user()->role) === 'petugas')
                    <div class="pt-6 pb-2">
                        <p class="sidebar-label px-4 text-[11px] font-bold text-blue-300/50 uppercase tracking-wider">Operasional (Petugas)</p>
                    </div>
                    
                    <a href="{{ route('petugas.transaksi.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('petugas.transaksi.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-right-to-bracket w-7 shrink-0"></i><span class="sidebar-label">Transaksi Parkir</span>
                    </a>
                    <a href="{{ route('petugas.transaksi.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('petugas.struk.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-print w-7 shrink-0"></i><span class="sidebar-label">Cetak Struk Parkir</span>
                    </a>
                @endif

                <!-- OWNER -->
                @if(strtolower(Auth::user()->role) === 'owner')
                    <div class="pt-6 pb-2">
                        <p class="sidebar-label px-4 text-[11px] font-bold text-blue-300/50 uppercase tracking-wider">Laporan (Owner)</p>
                    </div>
                    
                    <a href="{{ route('owner.laporan.index') }}" 
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-blue-500/10 hover:text-blue-400 text-slate-300 {{ request()->routeIs('owner.laporan.*') ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : '' }}">
                        <i class="fa-solid fa-file-invoice-dollar w-7 shrink-0"></i><span class="sidebar-label">Rekap Transaksi</span>
                    </a>
                @endif

            </nav>                
               <!-- User Profile & Logout Box -->
            <div class="p-4 bg-black/20 border-t border-blue-500/20">
                <div class="flex items-center gap-3 mb-4 px-2">
                    <div class="h-10 w-10 shrink-0 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 font-bold border border-blue-500/30">
                        {{ substr(Auth::user()->nama_lengkap ?? Auth::user()->username ?? 'U', 0, 1) }}
                    </div>
                    <div class="sidebar-label overflow-hidden">
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
                        <i class="fa-solid fa-power-off shrink-0"></i><span class="sidebar-label">Logout Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-slate-950/70 backdrop-blur-sm md:hidden"></div>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Ornamen Dekorasi Background -->
            <div class="absolute top-0 left-0 w-full h-96 bg-blue-600/5 blur-[120px] pointer-events-none"></div>

            <!-- Top Header -->
            <header class="h-20 border-b border-blue-500/20 bg-[#071426]/60 backdrop-blur-md flex items-center justify-between px-4 md:px-8 z-10">
                <div class="flex min-w-0 items-center gap-3">
                    <button id="sidebar-toggle" type="button" aria-label="Buka menu navigasi" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-blue-500/20 bg-blue-500/10 text-blue-200 hover:bg-blue-500/20 md:hidden">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h2 class="text-base md:text-xl font-bold text-white truncate">Sistem Manajemen Parkir Terpadu</h2>
                </div>
                <div class="hidden sm:flex items-center gap-4 text-sm font-medium text-blue-200/80 bg-blue-500/10 border border-blue-500/20 px-4 py-2 rounded-full">
                    <i class="fa-regular fa-clock text-blue-400"></i>
                    <span>{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                </div>
            </header>

            <!-- Halaman Dinamis -->
            <div class="flex-1 overflow-y-auto p-4 md:p-8 z-10 custom-scrollbar">
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

        @media (min-width: 768px) {
            #app-sidebar {
                width: 18rem;
            }

            #sidebar-resizer {
                position: absolute;
                top: 0;
                right: -3px;
                z-index: 50;
                width: 6px;
                height: 100%;
                cursor: col-resize;
                transition: background-color 150ms ease;
            }

            #sidebar-resizer:hover,
            #sidebar-resizer:focus-visible,
            #app-shell.sidebar-resizing #sidebar-resizer {
                background: rgba(59, 130, 246, 0.8);
            }

            #app-shell.sidebar-resizing #app-sidebar {
                transition: transform 300ms ease-in-out;
            }
        }

        @media (max-width: 767px) {
            #sidebar-resizer { display: none; }
        }

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
            const sidebar = document.getElementById('app-sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const sidebarResizer = document.getElementById('sidebar-resizer');

            const savedSidebarWidth = Number(localStorage.getItem('sidebar-width'));
            if (savedSidebarWidth >= 220 && savedSidebarWidth <= 420 && window.innerWidth >= 768) {
                sidebar.style.width = savedSidebarWidth + 'px';
            }

            let resizingSidebar = false;

            function updateSidebarWidth(clientX) {
                const width = Math.min(420, Math.max(220, clientX));
                sidebar.style.width = width + 'px';
                localStorage.setItem('sidebar-width', String(width));
            }

            sidebarResizer.addEventListener('pointerdown', function (event) {
                if (window.innerWidth < 768) {
                    return;
                }

                resizingSidebar = true;
                sidebarResizer.setPointerCapture(event.pointerId);
                document.body.style.cursor = 'col-resize';
                document.body.style.userSelect = 'none';
                document.getElementById('app-shell').classList.add('sidebar-resizing');
            });

            sidebarResizer.addEventListener('pointermove', function (event) {
                if (resizingSidebar) {
                    updateSidebarWidth(event.clientX);
                }
            });

            function stopSidebarResize(event) {
                if (!resizingSidebar) {
                    return;
                }

                resizingSidebar = false;
                if (event && sidebarResizer.hasPointerCapture(event.pointerId)) {
                    sidebarResizer.releasePointerCapture(event.pointerId);
                }
                document.body.style.cursor = '';
                document.body.style.userSelect = '';
                document.getElementById('app-shell').classList.remove('sidebar-resizing');
            }

            sidebarResizer.addEventListener('pointerup', stopSidebarResize);
            sidebarResizer.addEventListener('pointercancel', stopSidebarResize);
            sidebarResizer.addEventListener('keydown', function (event) {
                if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') {
                    return;
                }

                event.preventDefault();
                const currentWidth = sidebar.getBoundingClientRect().width;
                updateSidebarWidth(currentWidth + (event.key === 'ArrowRight' ? 16 : -16));
            });

            function setMobileSidebar(open) {
                sidebar.classList.toggle('-translate-x-full', !open);
                sidebar.classList.toggle('translate-x-0', open);
                sidebarOverlay.classList.toggle('hidden', !open);
                document.body.classList.toggle('overflow-hidden', open);
            }

            sidebarToggle.addEventListener('click', function () {
                setMobileSidebar(sidebar.classList.contains('-translate-x-full'));
            });

            sidebarOverlay.addEventListener('click', function () {
                setMobileSidebar(false);
            });

            sidebar.querySelectorAll('nav a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 768) {
                        setMobileSidebar(false);
                    }
                });
            });

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