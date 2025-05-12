<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek jika user belum login
        if (!Auth::check()) {
            abort(401, 'Oops! You are not authorized to access this page.');
        }
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah role user sesuai dengan yang diizinkan
        if (!in_array($user->role, $roles)) {
            // Jika tidak sesuai, redirect ke halaman dashboard atau halaman login dengan pesan error
            abort(403, 'You do not have permission to access this page.');
        }

        // Jika lolos semua pengecekan, lanjut ke request berikutnya
        return $next($request);
    }
}
