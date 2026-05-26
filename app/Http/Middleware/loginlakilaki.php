<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\DataAlumni;
use Illuminate\Support\Facades\Auth;

class loginlakilaki
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $alumni = DataAlumni::where('nim', $user->username)->first();

        if ($alumni && $alumni->jenis_kelamin === 'Laki-laki') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Alumni perempuan.');
        }


        return $next($request);
    }
}