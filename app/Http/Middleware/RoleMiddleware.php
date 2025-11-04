<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Middleware untuk membatasi akses berdasarkan role.
     * Contoh: ->middleware('role:owner') atau ->middleware('role:admin')
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $user = Auth::user();

        // Kalau belum login, arahkan ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // Pisahkan role jika lebih dari satu, contoh 'owner,admin'
        $allowed = array_map('trim', explode(',', $roles));

        // Jika role user sesuai dengan allowed → izinkan lanjut
        if (in_array($user->role, $allowed, true)) {
            return $next($request);
        }

        // 🔹 Logika redirect otomatis biar lebih nyaman:
        // Jika admin nyasar ke halaman owner, lempar ke dashboardAdmin
        if ($user->role === 'admin') {
            return redirect()->route('dashboardAdmin')
                ->with('error', 'Anda tidak punya akses ke halaman tersebut, dialihkan ke Dashboard Admin.');
        }

        // Jika owner nyasar ke halaman admin (biasanya boleh), kita tetap izinkan.
        if ($user->role === 'owner') {
            return $next($request);
        }

        // Default: tampilkan error 403
        abort(403, 'Akses tidak diizinkan.');
    }
}
