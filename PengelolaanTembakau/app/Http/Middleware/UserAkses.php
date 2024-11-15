<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve role from session
        $userRole = session('role'); // Sesuaikan dengan cara Anda menyimpan peran pengguna

        // Get the required role from route parameters or middleware arguments
        $requiredRole = $request->route()->parameter('role');

        // Check if the user's role matches the required role
        if ($userRole === $requiredRole) {
            return $next($request);
        }

        // Redirect or return an error response if the role does not match
        return response()->view('error-404'); // atau gunakan response()->json() untuk API responses
    }
}