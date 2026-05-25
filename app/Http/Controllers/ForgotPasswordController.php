<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;           // <-- WAJIB: Agar bisa cari user di database
use Illuminate\Support\Facades\Hash; // <-- WAJIB: Agar bisa enkripsi password
class ForgotPasswordController extends Controller
{
    public function index() {
        return view('forgot-password');
    }
 public function reset(Request $request) {
    $request->validate(['username' => 'required']);

    // Cari user berdasarkan username yang diinput di form
    $user = \App\Models\User::where('username', $request->username)->first();

    if ($user) {
        // Cek apakah user adalah alumni
        if ($user->role !== 'Alumni') {
            return back()->withErrors(['username' => 'Fitur forgot password hanya tersedia untuk alumni!']);
        }

        // Ambil NIM dari database, lalu enkripsi jadi password
        // Ganti baris ini di ForgotPasswordController:
$user->password = \Illuminate\Support\Facades\Hash::make($user->username); // Pakai username saja

        // Simpan perubahan ke database
        if ($user->save()) {
            return back()->with('status', 'Password berhasil di-reset menjadi NIM!');
        }
    }

    return back()->withErrors(['username' => 'Username tidak ditemukan!']);
}
}