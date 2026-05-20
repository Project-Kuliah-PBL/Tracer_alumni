<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAlumni;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
        ]);

        // Cari user berdasarkan field 'username' (bukan email)
        $user = \App\Models\User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['Username atau password salah.'],
            ]);
        }

        // Hanya Admin dan SuperAdmin yang boleh login ke aplikasi mobile admin
        if (! in_array($user->role, ['Admin', 'SuperAdmin'])) {
            return response()->json([
                'message' => 'Akun ini tidak memiliki akses ke panel admin.',
            ], 403);
        }

        // Hapus token lama (opsional – cegah akumulasi token)
        $user->tokens()->delete();

        $token = $user->createToken('mobile-admin')->plainTextToken;

        // Ambil nama display dari data_alumni jika ada
        $namaDisplay = $user->role === 'Alumni'
            ? optional(DataAlumni::where('nim', $user->username)->first())->nama
            : $user->username;

        return response()->json([
            'token' => $token,
            'role'  => $user->role,
            'prodi' => $user->prodi,
            'user'  => [
                'id'       => $user->id,
                'username' => $user->username,
                'nama'     => $namaDisplay,
                'role'     => $user->role,
                'prodi'    => $user->prodi,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        // Hapus hanya token yang sedang digunakan
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil.']);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        $namaDisplay = $user->role === 'Alumni'
            ? optional(DataAlumni::where('nim', $user->username)->first())->nama
            : $user->username;

        return response()->json([
            'id'       => $user->id,
            'username' => $user->username,
            'nama'     => $namaDisplay,
            'role'     => $user->role,
            'prodi'    => $user->prodi,
        ]);
    }
}
