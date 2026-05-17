<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DataAlumni;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaAkunController extends Controller
{
    public function index(Request $request)
    {
        $search       = $request->get('search');
        $isSuperAdmin = auth()->user()->role === 'SuperAdmin';
        $prodiFilter  = $isSuperAdmin ? null : auth()->user()->prodi;

        // Alumni rows (dari data_alumni)
        $alumniQuery = DataAlumni::when($search, function ($query) use ($search) {
            $query->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
        })->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
          ->orderBy('created_at', 'desc');

        $alumni = $alumniQuery->paginate(10)->withQueryString();

        // Akun Admin per prodi (hanya tampil untuk SuperAdmin)
        $adminAccounts = collect();
        if ($isSuperAdmin) {
            $adminAccounts = User::where('role', 'Admin')
                ->when($search, fn($q) => $q->where('username', 'like', "%{$search}%"))
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $prodis = Prodi::orderBy('nama')->pluck('nama');

        return response(view('Admin.kelolaakun', compact('alumni', 'search', 'prodis', 'adminAccounts', 'isSuperAdmin')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    public function store(Request $request)
    {
        $isSuperAdmin = auth()->user()->role === 'SuperAdmin';
        $requestedRole = $isSuperAdmin ? $request->role : 'Alumni';
        $isAdminRole = ($requestedRole === 'Admin');

        $rules = [
            'nim'      => 'required|string|unique:users,username',
            'password' => 'nullable|string|min:6',
            'role'     => $isSuperAdmin ? 'required|in:Alumni,Admin' : 'nullable',
            'prodi'    => 'required_if:role,Admin|nullable|string|exists:prodi,nama',
        ];

        // Nama hanya wajib untuk Alumni
        if (!$isAdminRole) {
            $rules['nim'] .= '|unique:data_alumni,nim';
            $rules['nama'] = 'required|string|max:255';
        }

        $request->validate($rules, [
            'nim.required'      => 'NIM / Username tidak boleh kosong.',
            'nim.unique'        => 'NIM / Username sudah terdaftar.',
            'nama.required'     => 'Nama tidak boleh kosong.',
            'password.min'      => 'Password minimal 6 karakter.',
            'role.required'     => 'Role harus dipilih.',
            'role.in'           => 'Role tidak valid.',
            'prodi.required_if' => 'Program Studi harus dipilih untuk akun Admin.',
            'prodi.exists'      => 'Program Studi tidak valid.',
        ]);

        $role  = $isAdminRole ? 'Admin' : 'Alumni';
        $prodi = $isSuperAdmin ? $request->prodi : auth()->user()->prodi;

        User::create([
            'username' => $request->nim,
            'password' => Hash::make($request->filled('password') ? $request->password : $request->nim),
            'role'     => $role,
            'prodi'    => $role === 'Admin' ? $prodi : null,
        ]);

        // Hanya buat data_alumni jika role Alumni
        if ($role === 'Alumni') {
            DataAlumni::create([
                'nim'          => $request->nim,
                'nama'         => $request->nama,
                'prodi'        => $prodi,
                'angkatan'     => $request->angkatan,
                'tahun_lulus'  => $request->tahun_lulus ?: null,
                'jenis_kelamin'=> $request->jenis_kelamin,
            ]);
        }

        return redirect()->route('admin.kelola_akun')
            ->with('success', "Akun {$role} " . ($request->nama ?: $request->nim) . " berhasil ditambahkan.");
    }

    public function update(Request $request, string $nim)
    {
        $isSuperAdmin = auth()->user()->role === 'SuperAdmin';

        $request->validate([
            'nama'           => 'required|string|max:255',
            'angkatan'       => 'nullable|string|max:10',
            'password'       => 'nullable|string|min:6',
            'prodi'          => 'nullable|string|exists:prodi,nama',
        ], [
            'nama.required'  => 'Nama tidak boleh kosong.',
            'password.min'   => 'Password minimal 6 karakter.',
            'prodi.exists'   => 'Program Studi tidak valid.',
        ]);

        $alumni = DataAlumni::when(!$isSuperAdmin, fn($q) => $q->where('prodi', auth()->user()->prodi))
            ->where('nim', $nim)
            ->firstOrFail();

        $alumni->update([
            'nama'           => $request->nama,
            'prodi'          => $isSuperAdmin ? $request->prodi : auth()->user()->prodi,
            'angkatan'       => $request->angkatan,
            'tahun_lulus'    => $request->tahun_lulus ?: null,
            'jenis_kelamin'  => $request->jenis_kelamin,
        ]);

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
        $isSuperAdmin = auth()->user()->role === 'SuperAdmin';

        DataAlumni::when(!$isSuperAdmin, fn($q) => $q->where('prodi', auth()->user()->prodi))
            ->where('nim', $nim)
            ->delete();

        User::where('username', $nim)->delete();

        return redirect()->route('admin.kelola_akun')
            ->with('success', "Akun alumni berhasil dihapus.");
    }

    // Hapus akun Admin per prodi (SuperAdmin only)
    public function destroyAdmin(int $id)
    {
        $user = User::where('id', $id)->where('role', 'Admin')->firstOrFail();
        $user->delete();

        return redirect()->route('admin.kelola_akun')
            ->with('success', "Akun Admin berhasil dihapus.");
    }
}