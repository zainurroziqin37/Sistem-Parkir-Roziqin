<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Parkir Roziqin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-blue-900 via-black to-blue-900 flex items-center justify-center min-h-screen font-sans">

    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl"></div>
    </div>

    <div class="relative bg-black/40 backdrop-blur-xl w-full max-w-md p-8 rounded-2xl shadow-2xl border border-blue-500/30">
        
        <div class="text-center mb-8">
            <div class="inline-block mb-4 p-3 bg-blue-600/20 rounded-lg">
                <svg class="w-8 h-8 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white">Selamat Datang</h1>
            <p class="text-sm text-blue-200 mt-2">Sistem Parkir Roziqin</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="username" class="block text-sm font-semibold text-blue-100 mb-2">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Username" 
                        value="{{ old('username') }}"
                        required 
                        class="w-full pl-12 pr-4 py-3 bg-black/50 border border-blue-500/50 rounded-lg text-white placeholder-gray-400 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-sm font-semibold text-blue-100">Password</label>
                    <a href="#" class="text-xs text-blue-400 hover:text-blue-300 font-medium transition">Lupa sandi?</a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="password" 
                        required 
                        class="w-full pl-12 pr-4 py-3 bg-black/50 border border-blue-500/50 rounded-lg text-white placeholder-gray-400 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                </div>
            </div>

            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember" 
                    class="h-4 w-4 text-blue-500 bg-black/50 border-blue-500/50 rounded focus:ring-blue-500"
                >
                <label for="remember" class="ml-2 block text-sm text-blue-100">
                    Ingat saya di perangkat ini
                </label>
            </div>

            <div>
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105"
                >
                    Masuk ke Sistem
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm text-blue-300">
            Belum punya akun pengelola? 
            <a href="#" class="text-blue-400 font-semibold hover:text-blue-300 transition">Hubungi Administrator</a>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swalTheme = {
                background: '#071426',
                color: '#e2e8f0',
                confirmButtonColor: '#2563eb'
            };

            @if ($errors->any())
                Swal.fire({
                    ...swalTheme,
                    icon: 'error',
                    title: 'Login gagal',
                    text: @json($errors->first()),
                    confirmButtonText: 'Tutup'
                });
            @elseif (session('error'))
                Swal.fire({
                    ...swalTheme,
                    icon: 'error',
                    title: 'Login gagal',
                    text: @json(session('error')),
                    confirmButtonText: 'Tutup'
                });
            @endif
        });
    </script>

</body>
</html>