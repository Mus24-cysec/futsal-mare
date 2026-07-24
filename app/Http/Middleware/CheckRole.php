<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Jika user yang login tidak memiliki role yang diizinkan, arahkan ke dashboard masing-masing
        if (!in_array($user->role, $roles)) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak. Anda adalah Admin.');
            } elseif ($user->role === 'staff') {
                return redirect()->route('staff.scanner')->with('error', 'Akses ditolak. Anda adalah Staff.');
            }
            
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}