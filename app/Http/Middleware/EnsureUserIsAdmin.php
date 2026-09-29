<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user belum login atau bukan admin, hentikan request dengan status HTTP 403 (Forbidden)
        if (! $request->user() || ! $request->user()->is_admin) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang administrator.');
        }

        return $next($request);
    }
}
