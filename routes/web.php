<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KelolaAkunController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Alumni\DashboardController as AlumniDashboardController;
use App\Http\Controllers\Alumni\ProfilController;
use App\Http\Controllers\Alumni\PekerjaanController;
use App\Http\Controllers\Alumni\PendidikanController;
use App\Http\Controllers\Alumni\SertifikasiController;
use App\Http\Controllers\Alumni\MediaSosialController;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Cari Alumni - bisa diakses siapa saja (publik)
Route::get('/cari-alumni', function () {
    return view('carialumni');
})->name('cari.alumni');

Route::get('/biodata-alumni/{nim}', function ($nim) {
    $alumni = \App\Models\DataAlumni::with([
        'pekerjaan', 'riwayatPendidikan', 'sertifikasi', 'mediaSosial'
    ])->findOrFail($nim);

    return view('biodataalumni', compact('alumni'));
})->name('alumni.biodata');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang butuh login
Route::middleware('auth')->group(function () {

    // Admin only
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/kelola-akun', [KelolaAkunController::class, 'index'])->name('admin.kelola_akun');
        Route::post('/admin/kelola-akun', [KelolaAkunController::class, 'store'])->name('admin.kelola_akun.store');
        Route::put('/admin/kelola-akun/{nim}', [KelolaAkunController::class, 'update'])->name('admin.kelola_akun.update');
        Route::delete('/admin/kelola-akun/{nim}', [KelolaAkunController::class, 'destroy'])->name('admin.kelola_akun.destroy');
    });

Route::get('/admin/kelola-prodi', function () {
    return view('admin.kelolaprodi');
})->name('admin.kelolaprodi');

Route::get('/admin/edit-biodata', function () {
    return view('admin.editbiodata');
})->name('admin.editbiodata');
Route::get('/admin/biodata-alumni', function () {
    return view('admin.biodata'); 
})->name('admin.biodata');

    // Alumni only
    Route::middleware('alumni')->group(function () {

       
        // Dashboard
        Route::get('/alumni/dashboard', [AlumniDashboardController::class, 'index'])->name('alumni.dashboard');

        // Profil
        Route::get('/alumni/profil/edit',   [ProfilController::class, 'edit'])->name('alumni.profil.edit');
        Route::put('/alumni/profil/update', [ProfilController::class, 'update'])->name('alumni.profil.update');

        // Pengalaman Kerja
        Route::get('/alumni/pekerjaan',              [PekerjaanController::class, 'index'])->name('alumni.pekerjaan.index');
        Route::get('/alumni/pekerjaan/tambah',       [PekerjaanController::class, 'create'])->name('alumni.pekerjaan.create');
        Route::post('/alumni/pekerjaan',             [PekerjaanController::class, 'store'])->name('alumni.pekerjaan.store');
        Route::get('/alumni/pekerjaan/{id}/edit',    [PekerjaanController::class, 'edit'])->name('alumni.pekerjaan.edit');
        Route::put('/alumni/pekerjaan/{id}',         [PekerjaanController::class, 'update'])->name('alumni.pekerjaan.update');
        Route::delete('/alumni/pekerjaan/{id}',      [PekerjaanController::class, 'destroy'])->name('alumni.pekerjaan.destroy');

        // Riwayat Pendidikan
        Route::get('/alumni/pendidikan',             [PendidikanController::class, 'index'])->name('alumni.pendidikan.index');
        Route::get('/alumni/pendidikan/tambah',      [PendidikanController::class, 'create'])->name('alumni.pendidikan.create');
        Route::post('/alumni/pendidikan',            [PendidikanController::class, 'store'])->name('alumni.pendidikan.store');
        Route::put('/alumni/pendidikan/{id}',        [PendidikanController::class, 'update'])->name('alumni.pendidikan.update');
        Route::delete('/alumni/pendidikan/{id}',     [PendidikanController::class, 'destroy'])->name('alumni.pendidikan.destroy');

        // Sertifikasi & Pencapaian
        Route::get('/alumni/sertifikasi',            [SertifikasiController::class, 'index'])->name('alumni.sertifikasi.index');
        Route::get('/alumni/sertifikasi/tambah',     [SertifikasiController::class, 'create'])->name('alumni.sertifikasi.create');
        Route::post('/alumni/sertifikasi',           [SertifikasiController::class, 'store'])->name('alumni.sertifikasi.store');
        Route::put('/alumni/sertifikasi/{id}',       [SertifikasiController::class, 'update'])->name('alumni.sertifikasi.update');
        Route::delete('/alumni/sertifikasi/{id}',    [SertifikasiController::class, 'destroy'])->name('alumni.sertifikasi.destroy');

        // Media Sosial
        Route::post('/alumni/medsos',         [MediaSosialController::class, 'store'])->name('alumni.medsos.store');
        Route::put('/alumni/medsos/bulk',     [MediaSosialController::class, 'bulkUpdate'])->name('alumni.medsos.bulk');
        Route::put('/alumni/medsos/{id}',     [MediaSosialController::class, 'update'])->name('alumni.medsos.update');
        Route::delete('/alumni/medsos/{id}',  [MediaSosialController::class, 'destroy'])->name('alumni.medsos.destroy');

        // Manajemen Akun
        Route::get('/alumni/manajemen-akun',  [ProfilController::class, 'edit'])->name('alumni.manajemen_akun');
        Route::put('/alumni/manajemen-akun',  [ProfilController::class, 'updatePassword'])->name('alumni.manajemen_akun.update');
    });

});