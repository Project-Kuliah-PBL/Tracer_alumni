<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Tampilkan form edit profil (halaman manajemen akun).
     */
    public function edit()
    {
        $nim   = Auth::user()->username;
        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();

        return response(view('Alumni.manajemen_akun', compact('alumni')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Simpan perubahan data profil.
     */
    public function update(Request $request)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama'             => 'required|string|max:255',
            'alamat'           => 'nullable|string|max:500',
            'jenis_kelamin'    => 'nullable|in:Laki-laki,Perempuan',
            'email'            => 'nullable|email|max:255|unique:data_alumni,email,' . $nim . ',nim',
            'no_telepon'       => 'nullable|string|max:20',
            'lama_tunggu_kerja'=> 'nullable|string|max:100',
            'jabatan_sekarang' => 'nullable|string|max:255',
            'foto_profile'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_sampul'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ], [
            'nama.required'    => 'Nama tidak boleh kosong.',
            'email.email'      => 'Format email tidak valid.',
            'email.unique'     => 'Email sudah digunakan alumni lain.',
            'foto_profile.image' => 'File harus berupa gambar.',
            'foto_profile.max'   => 'Ukuran foto profil maksimal 2MB.',
            'foto_sampul.max'    => 'Ukuran foto sampul maksimal 4MB.',
        ]);

        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();

        $data = $request->only([
            'nama', 'alamat', 'jenis_kelamin', 'email',
            'no_telepon', 'lama_tunggu_kerja', 'jabatan_sekarang',
        ]);

        // Simpan preferensi visibilitas kontak HANYA jika request dari modal kontak.
        // Form lain (edit profil, foto, dll) tidak mengirim '_update_kontak',
        // sehingga nilai show_email/show_telepon yang sudah ada di DB tidak ikut di-reset.
        if ($request->has('_update_kontak')) {
            $data['show_email']   = $request->has('show_email');
            $data['show_telepon'] = $request->has('show_telepon');
        }

        // Upload foto profil
        if ($request->hasFile('foto_profile')) {
            if ($alumni->foto_profile) {
                Storage::disk('public')->delete($alumni->foto_profile);
            }
            $data['foto_profile'] = $request->file('foto_profile')
                ->store('foto_profile', 'public');
        }

        // Upload foto sampul
        if ($request->hasFile('foto_sampul')) {
            if ($alumni->foto_sampul) {
                Storage::disk('public')->delete($alumni->foto_sampul);
            }
            $data['foto_sampul'] = $request->file('foto_sampul')
                ->store('foto_sampul', 'public');
        }

        $alumni->update($data);

        return redirect()->route('alumni.dashboard')
            ->with('success_popup', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password alumni dari halaman Manajemen Akun.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'current_password.required' => 'Password saat ini tidak boleh kosong.',
            'password.required'         => 'Password baru tidak boleh kosong.',
            'password.min'              => 'Password baru minimal 8 karakter.',
            'password.confirmed'        => 'Konfirmasi password tidak cocok.',
        ]);

        // Cek apakah password saat ini benar
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai.',
            ])->with('error', 'Password saat ini salah.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('alumni.manajemen_akun')
            ->with('success', 'Password berhasil diperbarui. Silakan login kembali.');
    }
}