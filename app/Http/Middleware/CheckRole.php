<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            return response("<h1>403 - Akses Ditolak</h1><p>Maaf, Anda ({$user->role}) tidak memiliki hak
             akses untuk membuka halaman ini di POS Barokah Mart.</p><a href='/dashboard'>
             Kembali ke Dashboard</a>", 403);
        }

        return $next($request);
    }
}
