<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DataAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KelolaAkunController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $alumni = DataAlumni::when($search, function ($query) use ($search) {
            $query->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return response(view('Admin.kelolaakun', compact('alumni', 'search')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'      => 'required|string|unique:users,username|unique:data_alumni,nim',
            'nama'     => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ], [
            'nim.required'  => 'NIM tidak boleh kosong.',
            'nim.unique'    => 'NIM sudah terdaftar.',
            'nama.required' => 'Nama tidak boleh kosong.',
            'password.min'  => 'Password minimal 6 karakter.',
        ]);

        User::create([
            'username' => $request->nim,
            'password' => Hash::make($request->filled('password') ? $request->password : $request->nim),
            'role'     => 'Alumni',
        ]);

        DataAlumni::create([
            'nim'          => $request->nim,
            'nama'         => $request->nama,
            'prodi'        => $request->prodi,
            'tahun_lulus'  => $request->tahun_lulus ? $request->tahun_lulus . '-01-01' : null,
            'jenis_kelamin'=> $request->jenis_kelamin,
        ]);

        return redirect()->route('admin.kelola_akun')
            ->with('success', "Akun alumni {$request->nama} berhasil ditambahkan.");
    }

    public function update(Request $request, string $nim)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'password.min'  => 'Password minimal 6 karakter.',
        ]);

        DataAlumni::where('nim', $nim)->update([
            'nama'         => $request->nama,
            'prodi'        => $request->prodi,
            'tahun_lulus'  => $request->tahun_lulus ? $request->tahun_lulus . '-01-01' : null,
            'jenis_kelamin'=> $request->jenis_kelamin,
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            User::where('username', $nim)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.kelola_akun')
            ->with('success', "Akun alumni berhasil diperbarui.");
    }

    public function destroy(string $nim)
    {
        DataAlumni::where('nim', $nim)->delete();
        User::where('username', $nim)->delete();

        return redirect()->route('admin.kelola_akun')
            ->with('success', "Akun alumni berhasil dihapus.");
    }
}
