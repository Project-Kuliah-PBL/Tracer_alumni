<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KelolaAkunController;
use App\Http\Controllers\Admin\DashboardController;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Cari Alumni - bisa diakses siapa saja (publik)
Route::get('/cari-alumni', function () {
    return view('carialumni');
})->name('cari.alumni');



// Route untuk Riwayat Pendidikan
Route::get('/alumni/pendidikan', function () {
    $educations = [
        [
            'id' => 1,
            'institution' => 'Universitas Indonesia',
            'degree' => 'S1 Teknik Informatika',
            'start_year' => '2016',
            'end_year' => '2020',
            'ipk' => '3.80',
            'thesis_label' => 'Judul Skripsi : Sistem Informasi Alumni',
        ],
        [
            'id'          => 2,
            'degree'      => 'S2 Ilmu Komputer',
            'institution' => 'Institut Teknologi Bandung',
            'thesis_label'=> 'Judul Tesis : Implementasi Machine Learning',
            'start_year'  => '2022',
            'end_year'    => '2024',
            'ipk'         => '3.90',
        ],
    ];

    return view('Alumni.edit_riwayat_pendidikan', compact('educations'));
})->name('alumni.pendidikan');

// Route untuk Pengalaman Kerja
Route::get('/alumni/pengalaman-kerja', function () {
    $experiences = [
        [
            'id'          => 1,
            'title'       => 'Software Engineer',
            'company'     => 'PT Teknologi Indonesia',
            'period'      => 'Jan 2022 - Sekarang',
            'status'      => 'Full-time',
            'type'        => 'tetap',
            'description' => 'Mengembangkan aplikasi web perusahaan menggunakan Laravel dan Vue.js.',
        ],
        [
            'id'          => 2,
            'title'       => 'Web Developer Intern',
            'company'     => 'Digital Agency',
            'period'      => 'Jun 2021 - Des 2021',
            'status'      => 'Internship',
            'type'        => 'magang',
            'description' => 'Membantu pembuatan landing page untuk klien agensi.',
        ],
    ];

    return view('Alumni.edit_pengalaman_kerja', compact('experiences'));
})->name('alumni.pengalaman-kerja');

// Route untuk Pencapaian & Sertifikasi
Route::get('/alumni/pencapaian', function () {
    $certifications = [
        [
            'id'            => 1,
            'title'         => 'Google Data Analytics Professional Certificate',
            'provider'      => 'Google Career Certificates',
            'issue_date'    => 'Okt 2023',
            'credential_id' => 'GDA-2023-XYZ-9981',
        ],
        [
            'id'            => 2,
            'title'         => 'TOEFL ITP Score: 610',
            'provider'      => 'ETS - Educational Testing Service',
            'issue_date'    => 'Jan 2024',
            'credential_id' => null,
        ],
        [
            'id'            => 3,
            'title'         => 'Project Management Professional (PMP)',
            'provider'      => 'Project Management Institute (PMI)',
            'issue_date'    => 'Mei 2022',
            'credential_id' => 'PMI-2022-PMP-1102',
        ],
    ];

    return view('Alumni.sertifikasi', compact('certifications'));
})->name('alumni.pencapaian');



// Route untuk Manajemen Akun
Route::get('/alumni/manajemen-akun', function () {
    // Jika nanti Anda butuh mengirim data user, bisa didefinisikan di sini
    // Contoh: $user = [ 'nama' => 'Budi', 'email' => 'budi@email.com' ];

    // Memanggil resources/views/Alumni/manajemen_akun.blade.php
    return view('Alumni.manajemen_akun');
})->name('alumni.manajemen_akun');


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
