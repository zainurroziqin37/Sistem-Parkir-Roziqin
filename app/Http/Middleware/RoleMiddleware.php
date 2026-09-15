<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user sudah login dan role-nya sesuai
        if (Auth::check()
            && strtolower(trim((string) Auth::user()->role)) === strtolower(trim($role))) {
            return $next($request);
        }

        // Jika tidak sesuai, tampilkan error 403 (Forbidden)
        abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}