<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataAlumni;
use Symfony\Component\HttpFoundation\Response;

class AlumniOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'Alumni') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Alumni.');
        }

        

        return $next($request);
    }
}
