<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->is_admin == 1)) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki otoritas Administrator.');
    }
}