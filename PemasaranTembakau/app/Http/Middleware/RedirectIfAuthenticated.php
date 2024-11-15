<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Periksa apakah pengguna sudah terautentikasi dengan guard tertentu
            if (Auth::guard($guard)->check()) {
                // Alihkan ke halaman yang sesuai jika sudah terautentikasi
                return redirect('/home'); // Ubah '/home' dengan URL yang sesuai jika diperlukan
            }
        }

        // Lanjutkan ke rute berikutnya jika pengguna tidak terautentikasi
        return $next($request);
    }
}
