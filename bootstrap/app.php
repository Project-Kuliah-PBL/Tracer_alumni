<?php

// Naikkan memory limit — default 128M tidak cukup untuk proses import Excel
// dan loading framework dengan banyak relasi Eloquent.
ini_set('memory_limit', '256M');

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin'      => \App\Http\Middleware\AdminOnly::class,
            'superadmin' => \App\Http\Middleware\SuperAdminOnly::class,
            'alumni'     => \App\Http\Middleware\AlumniOnly::class,
            'alumni-laki' => \App\Http\Middleware\loginlakilaki::class,
            'api.admin' => \App\Http\Middleware\ApiAdminMiddleware::class,
        ]);

        // Security headers untuk semua response
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);

        $middleware->redirectGuestsTo('/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Kembalikan JSON untuk semua error di request API
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthenticated. Token tidak valid atau sudah kadaluarsa.'], 401);
            }
        });

        $exceptions->render(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Data tidak ditemukan.'], 404);
            }
        });

        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Validasi gagal.',
                    'errors'  => $e->errors(),
                ], 422);
            }
        });

    })->create();
