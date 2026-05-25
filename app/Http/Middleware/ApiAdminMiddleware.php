<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, ['Admin', 'SuperAdmin'])) {
            return response()->json([
                'message' => 'Akses ditolak. Hanya Admin atau SuperAdmin yang diizinkan.',
            ], 403);
        }

        return $next($request);
    }
}
