<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAlumni;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KelolaAkunApiController extends Controller
{
    public function index(Request $request)
    {
        $user         = $request->user();
        $isSuperAdmin = $user->role === 'SuperAdmin';
        $prodiFilter  = $isSuperAdmin ? null : $user->prodi;
        $search       = $request->get('search');
        $perPage      = min((int) $request->get('per_page', 15), 50);

        $query = DataAlumni::when($search, function ($q) use ($search) {
            $q->where('nim', 'like', "%{$search}%")
              ->orWhere('nama', 'like', "%{$search}%");
        })->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
          ->orderBy('created_at', 'desc');

        $paginated = $query->paginate($perPage);

        return response()->json([
            'data'         => $paginated->items(),
            'total'        => $paginated->total(),
            'current_page' => $paginated->currentPage(),
            'last_page'    => $paginated->lastPage(),
            'per_page'     => $paginated->perPage(),
        ]);
    }

      public function store(Request $request)
    {
        $user         = $request->user();
        $isSuperAdmin = $user->role === 'SuperAdmin';
        $requestedRole = $isSuperAdmin ? ($request->role ?? 'Alumni') : 'Alumni';
        $isAdminRole   = $requestedRole === 'Admin';

        $rules = [
            'nim'      => ['required', 'string', 'unique:users,username'],
            'password' => ['nullable', 'string', 'min:6'],
            'role'     => $isSuperAdmin
                ? ['required', Rule::in(['Alumni', 'Admin'])]
                : ['nullable'],
            'prodi'    => [
                $isAdminRole ? 'required' : 'nullable',
                'string',
                'exists:prodi,nama',
            ],
        ];

        if (! $isAdminRole) {
            $rules['nim'][]  = 'unique:data_alumni,nim';
            $rules['nama']   = ['required', 'string', 'max:255'];
        }

        $validated = $request->validate($rules, [
            'nim.required'  => 'NIM tidak boleh kosong.',
            'nim.unique'    => 'NIM sudah terdaftar.',
            'nama.required' => 'Nama tidak boleh kosong.',
            'password.min'  => 'Password minimal 6 karakter.',
            'prodi.required'=> 'Program Studi harus dipilih untuk akun Admin.',
            'prodi.exists'  => 'Program Studi tidak valid.',
        ]);

        $role  = $isAdminRole ? 'Admin' : 'Alumni';
        $prodi = $isSuperAdmin ? $request->prodi : $user->prodi;

        User::create([
            'username' => $request->nim,
            'password' => Hash::make($request->filled('password') ? $request->password : $request->nim),
            'role'     => $role,
            'prodi'    => $role === 'Admin' ? $prodi : null,
        ]);

        if ($role === 'Alumni') {
            DataAlumni::create([
                'nim'           => $request->nim,
                'nama'          => $request->nama,
                'prodi'         => $prodi,
                'angkatan'      => $request->angkatan,
                'tahun_lulus'   => $request->tahun_lulus ?: null,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
        }

        return response()->json([
            'message' => "Akun {$role} berhasil ditambahkan.",
        ], 201);
    }

    public function update(Request $request, string $nim)
    {
        $user         = $request->user();
        $isSuperAdmin = $user->role === 'SuperAdmin';

        $request->validate([
            'nama'          => 'required|string|max:255',
            'angkatan'      => 'nullable|string|max:10',
            'password'      => 'nullable|string|min:6',
            'prodi'         => 'nullable|string|exists:prodi,nama',
            'tahun_lulus'   => 'nullable|date',
            'jenis_kelamin' => 'nullable|string',
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'password.min'  => 'Password minimal 6 karakter.',
            'prodi.exists'  => 'Program Studi tidak valid.',
        ]);

        $alumni = DataAlumni::when(! $isSuperAdmin, fn($q) => $q->where('prodi', $user->prodi))
            ->where('nim', $nim)
            ->firstOrFail();

        $alumni->update([
            'nama'          => $request->nama,
            'prodi'         => $isSuperAdmin ? $request->prodi : $user->prodi,
            'angkatan'      => $request->angkatan,
            'tahun_lulus'   => $request->tahun_lulus ?: null,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        if ($request->filled('password')) {
            User::where('username', $nim)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return response()->json(['message' => 'Akun berhasil diperbarui.']);
    }

    public function destroy(Request $request, string $nim)
    {
        $user         = $request->user();
        $isSuperAdmin = $user->role === 'SuperAdmin';

        DataAlumni::when(! $isSuperAdmin, fn($q) => $q->where('prodi', $user->prodi))
            ->where('nim', $nim)
            ->firstOrFail()
            ->delete();

        User::where('username', $nim)->delete();

        return response()->json(['message' => 'Akun berhasil dihapus.']);
    }
}
