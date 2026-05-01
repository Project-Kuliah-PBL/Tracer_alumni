<?php

use Illuminate\Support\Facades\Route;

// Route untuk halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Tambahkan Route untuk halaman Login
Route::get('/login', function () {
    return view('login'); //
})->name('login');

//Tambahkan untuk car alumni
Route::get('/cari-alumni', function () {
    return view('carialumni');
})->name('cari.alumni');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('admin.dashboard');

// Route untuk Halaman Kelola Akun
Route::get('/kelola-akun', function () {
    return view('kelolaakun');
})->name('admin.kelola_akun');