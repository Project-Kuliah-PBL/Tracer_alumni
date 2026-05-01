<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Cari Alumni - bisa diakses siapa saja (publik)
Route::get('/cari-alumni', function () {
    return view('carialumni');
})->name('cari.alumni');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang butuh login
Route::middleware('auth')->group(function () {

    // Admin only
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return response(view('Admin.dashboard'))->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
                'Pragma'        => 'no-cache',
                'Expires'       => '0',
            ]);
        })->name('admin.dashboard');

        Route::get('/admin/kelola-akun', function () {
            return response(view('Admin.kelolaakun'))->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
                'Pragma'        => 'no-cache',
                'Expires'       => '0',
            ]);
        })->name('admin.kelola_akun');
    });

    // Alumni only
    Route::middleware('alumni')->group(function () {
        Route::get('/alumni/dashboard', function () {
            return response(view('Alumni.dashboard'))->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
                'Pragma'        => 'no-cache',
                'Expires'       => '0',
            ]);
        })->name('alumni.dashboard');
    });

});
