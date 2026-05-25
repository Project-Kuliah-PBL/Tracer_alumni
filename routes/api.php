<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\KelolaAkunApiController;
use App\Http\Controllers\Api\ProdiApiController;
use App\Http\Controllers\Api\BiodataApiController;


// ── PUBLIC ────────────────────────────────────────────────────────────────
Route::post('/login', [AuthApiController::class, 'login']);

// ── PROTECTED (butuh Bearer Token dari Sanctum) ───────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/me',      [AuthApiController::class, 'me']);

    // ── Admin & SuperAdmin ────────────────────────────────────────────────
    Route::middleware('api.admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardApiController::class, 'index']);

        // Kelola Akun Alumni
        Route::get('/akun',             [KelolaAkunApiController::class, 'index']);
        Route::post('/akun',            [KelolaAkunApiController::class, 'store']);
        Route::put('/akun/{nim}',       [KelolaAkunApiController::class, 'update']);
        Route::delete('/akun/{nim}',    [KelolaAkunApiController::class, 'destroy']);

        // Biodata Alumni
        Route::get('/biodata',               [BiodataApiController::class, 'index']);
        Route::get('/biodata/{nim}',         [BiodataApiController::class, 'show']);

        // Pekerjaan Alumni (dari halaman biodata admin)
        Route::post('/biodata/{nim}/pekerjaan',          [BiodataApiController::class, 'storePekerjaan']);
        Route::delete('/biodata/{nim}/pekerjaan/{id}',   [BiodataApiController::class, 'destroyPekerjaan']);

        // Pendidikan Alumni (dari halaman biodata admin)
        Route::post('/biodata/{nim}/pendidikan',         [BiodataApiController::class, 'storePendidikan']);
        Route::delete('/biodata/{nim}/pendidikan/{id}',  [BiodataApiController::class, 'destroyPendidikan']);

        // Kelola Prodi (SuperAdmin saja, dicek di dalam controller)
        Route::get('/prodi',          [ProdiApiController::class, 'index']);
        Route::post('/prodi',         [ProdiApiController::class, 'store']);
        Route::put('/prodi/{id}',     [ProdiApiController::class, 'update']);
        Route::delete('/prodi/{id}',  [ProdiApiController::class, 'destroy']);
    });
});
