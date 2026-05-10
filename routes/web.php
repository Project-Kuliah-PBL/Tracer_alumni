<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KelolaAkunController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\BiodataController;
use App\Http\Controllers\Alumni\DashboardController as AlumniDashboardController;
use App\Http\Controllers\Alumni\ProfilController;
use App\Http\Controllers\Alumni\PekerjaanController;
use App\Http\Controllers\Alumni\PendidikanController;
use App\Http\Controllers\Alumni\SertifikasiController;
use App\Http\Controllers\Alumni\MediaSosialController;
use App\Http\Controllers\Alumni\AlumniController;

// ─────────────────────────────────────────────
// PUBLIC ROUTES (tidak butuh login)
// ─────────────────────────────────────────────

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Cari Alumni – dapat diakses siapa saja (publik)
Route::get('/cari-alumni', [AlumniController::class, 'index'])->name('alumni.search');

// Biodata / Detail Alumni – dapat diakses siapa saja (publik)
// Menggunakan nim sebagai parameter agar konsisten dengan model DataAlumni
Route::get('/cari-alumni/{nim}', [AlumniController::class, 'show'])->name('alumni.show');

// ─────────────────────────────────────────────
// AUTH ROUTES
// ─────────────────────────────────────────────

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─────────────────────────────────────────────
// PROTECTED ROUTES (butuh login)
// ─────────────────────────────────────────────

Route::middleware('auth')->group(function () {

    // ── Admin Only ────────────────────────────
    Route::middleware('admin')->group(function () {

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Kelola Akun
        Route::get('/admin/kelola-akun',          [KelolaAkunController::class, 'index'])  ->name('admin.kelola_akun');
        Route::post('/admin/kelola-akun',         [KelolaAkunController::class, 'store'])  ->name('admin.kelola_akun.store');
        Route::put('/admin/kelola-akun/{nim}',    [KelolaAkunController::class, 'update']) ->name('admin.kelola_akun.update');
        Route::delete('/admin/kelola-akun/{nim}', [KelolaAkunController::class, 'destroy'])->name('admin.kelola_akun.destroy');

        // Kelola Prodi
        Route::get('/admin/kelola-prodi',          [ProdiController::class, 'index'])  ->name('admin.prodi');
        Route::post('/admin/kelola-prodi',         [ProdiController::class, 'store'])  ->name('admin.prodi.store');
        Route::put('/admin/kelola-prodi/{prodi}',  [ProdiController::class, 'update']) ->name('admin.prodi.update');
        Route::delete('/admin/kelola-prodi/{prodi}',[ProdiController::class, 'destroy'])->name('admin.prodi.destroy');

        // Edit Biodata Alumni
        Route::get('/admin/edit-biodata', [BiodataController::class, 'index'])->name('admin.editbiodata');
        Route::get('/admin/biodata/{nim}', [BiodataController::class, 'show'])->name('admin.biodata');
        Route::post('/admin/biodata/{nim}/pekerjaan', [BiodataController::class, 'storePekerjaan'])->name('admin.biodata.pekerjaan.store');
        Route::delete('/admin/biodata/{nim}/pekerjaan/{id}', [BiodataController::class, 'destroyPekerjaan'])->name('admin.biodata.pekerjaan.destroy');
        Route::post('/admin/biodata/{nim}/pendidikan', [BiodataController::class, 'storePendidikan'])->name('admin.biodata.pendidikan.store');
        Route::delete('/admin/biodata/{nim}/pendidikan/{id}', [BiodataController::class, 'destroyPendidikan'])->name('admin.biodata.pendidikan.destroy');
    });

    // ── Alumni Only ───────────────────────────
    Route::middleware('alumni')->prefix('alumni')->name('alumni.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [AlumniDashboardController::class, 'index'])->name('dashboard');

        // Profil
        Route::get('/profil/edit',   [ProfilController::class, 'edit'])  ->name('profil.edit');
        Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

        // Pengalaman Kerja
        Route::get('/pekerjaan',           [PekerjaanController::class, 'index'])  ->name('pekerjaan.index');
        Route::get('/pekerjaan/tambah',    [PekerjaanController::class, 'create']) ->name('pekerjaan.create');
        Route::post('/pekerjaan',          [PekerjaanController::class, 'store'])  ->name('pekerjaan.store');
        Route::get('/pekerjaan/{id}/edit', [PekerjaanController::class, 'edit'])   ->name('pekerjaan.edit');
        Route::put('/pekerjaan/{id}',      [PekerjaanController::class, 'update']) ->name('pekerjaan.update');
        Route::delete('/pekerjaan/{id}',   [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');

        // Riwayat Pendidikan
        Route::get('/pendidikan',          [PendidikanController::class, 'index'])  ->name('pendidikan.index');
        Route::get('/pendidikan/tambah',   [PendidikanController::class, 'create']) ->name('pendidikan.create');
        Route::post('/pendidikan',         [PendidikanController::class, 'store'])  ->name('pendidikan.store');
        Route::put('/pendidikan/{id}',     [PendidikanController::class, 'update']) ->name('pendidikan.update');
        Route::delete('/pendidikan/{id}',  [PendidikanController::class, 'destroy'])->name('pendidikan.destroy');

        // Sertifikasi & Pencapaian
        Route::get('/sertifikasi',         [SertifikasiController::class, 'index'])  ->name('sertifikasi.index');
        Route::get('/sertifikasi/tambah',  [SertifikasiController::class, 'create']) ->name('sertifikasi.create');
        Route::post('/sertifikasi',        [SertifikasiController::class, 'store'])  ->name('sertifikasi.store');
        Route::put('/sertifikasi/{id}',    [SertifikasiController::class, 'update']) ->name('sertifikasi.update');
        Route::delete('/sertifikasi/{id}', [SertifikasiController::class, 'destroy'])->name('sertifikasi.destroy');

        // Media Sosial
        Route::post('/medsos',        [MediaSosialController::class, 'store'])     ->name('medsos.store');
        Route::put('/medsos/bulk',    [MediaSosialController::class, 'bulkUpdate'])->name('medsos.bulk');
        Route::put('/medsos/{id}',    [MediaSosialController::class, 'update'])    ->name('medsos.update');
        Route::delete('/medsos/{id}', [MediaSosialController::class, 'destroy'])   ->name('medsos.destroy');

        // Manajemen Akun
        Route::get('/manajemen-akun', [ProfilController::class, 'edit'])          ->name('manajemen_akun');
        Route::put('/manajemen-akun', [ProfilController::class, 'updatePassword'])->name('manajemen_akun.update');
    });
});