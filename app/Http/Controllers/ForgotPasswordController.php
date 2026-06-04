<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // ── 1. Tampilkan halaman lupa password ─────────────────────────────────
    public function index()
    {
        return view('forgot-password');
    }

    // ── 2. Cek username → pisah alur Alumni vs Admin ───────────────────────
    public function checkUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
        ], [
            'username.required' => 'Username tidak boleh kosong.',
        ]);

        $user = User::where('username', $request->username)->first();

        // Username tidak ditemukan — tampilkan pesan generik (keamanan)
        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak ditemukan.'])->withInput();
        }

        // ── Alumni → reset password jadi NIM (alur lama) ──
        if ($user->role === 'Alumni') {
            $user->password = Hash::make($user->username);
            $user->save();

            return back()->with('status',
                'Password berhasil direset. Silakan login menggunakan NIM Anda sebagai password.');
        }

        // ── Admin / SuperAdmin → arahkan ke form email ──
        if (in_array($user->role, ['Admin', 'SuperAdmin'])) {
            // Cek apakah admin sudah punya email terdaftar
            if (empty($user->email)) {
                return back()->withErrors([
                    'username' => 'Akun admin ini belum memiliki email terdaftar. '.
                                  'Hubungi SuperAdmin untuk menambahkan email.',
                ])->withInput();
            }

            // Kirim ke halaman input email dengan username tersimpan di session
            return redirect()->route('password.admin.form')
                ->with('admin_username', $request->username);
        }

        // Role tidak dikenali
        return back()->withErrors(['username' => 'Role akun tidak dikenali.'])->withInput();
    }

    // ── 3. Tampilkan form input email (khusus Admin) ────────────────────────
    public function showAdminEmailForm(Request $request)
    {
        if (!session('admin_username')) {
            return redirect()->route('password.request');
        }

        return view('forgot-password-admin');
    }

    // ── 4. Kirim link reset ke email Admin ─────────────────────────────────
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        // Cari admin berdasarkan email
        $user = User::where('email', $request->email)
                    ->whereIn('role', ['Admin', 'SuperAdmin'])
                    ->first();

        // Selalu tampilkan pesan sukses (mencegah enumerasi akun)
        if (!$user) {
            return back()->with('status',
                'Jika email terdaftar, link reset password akan segera dikirim.');
        }

        // Hapus token lama jika ada
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Generate token baru
        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email'      => $request->email,
            'token'      => Hash::make($token),
            'created_at' => now(),
        ]);

        // Kirim email
        $resetUrl = url(route('password.reset.form', [
            'token' => $token,
            'email' => $request->email,
        ], false));

        Mail::send('emails.reset-password', [
            'user'     => $user,
            'resetUrl' => $resetUrl,
        ], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset Password - Portal Alumni Polije');
        });

        return back()->with('status',
            'Link reset password telah dikirim ke email Anda. Link berlaku selama 60 menit.');
    }

    // ── 5. Tampilkan form reset password (dari link email) ──────────────────
    public function showResetForm(Request $request, string $token)
    {
        return view('reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // ── 6. Proses simpan password baru ─────────────────────────────────────
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'token'                 => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.required'  => 'Password tidak boleh kosong.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $record = DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->first();

        if (!$record) {
            return back()->withErrors(['email' => 'Link reset password tidak valid.']);
        }

        // Cek kadaluarsa (60 menit)
        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' =>
                'Link sudah kadaluarsa. Silakan minta link reset baru.']);
        }

        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Link reset password tidak valid.']);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        // Hapus token setelah dipakai
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('status', 'Password berhasil diubah. Silakan login dengan password baru.');
    }
}