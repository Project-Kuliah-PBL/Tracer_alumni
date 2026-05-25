<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;

class ProdiApiController extends Controller
{
    public function index(Request $request)
    {
        $prodis = Prodi::withCount(['alumni as total_alumni'])    // butuh relasi di Model Prodi
            ->orderBy('nama')
            ->get(['id', 'nama', 'kode_nim']);

        return response()->json([
            'data'  => $prodis,
            'total' => $prodis->count(),
        ]);
    }

    public function store(Request $request)
    {
        $this->requireSuperAdmin($request);

        $request->validate([
            'nama'     => 'required|string|max:255|unique:prodi,nama',
            'kode_nim' => 'nullable|string|max:20',
        ], [
            'nama.required' => 'Nama prodi tidak boleh kosong.',
            'nama.unique'   => 'Prodi sudah terdaftar.',
        ]);

        $prodi = Prodi::create([
            'nama'     => $request->nama,
            'kode_nim' => $request->kode_nim ? strtoupper(trim($request->kode_nim)) : null,
        ]);

        return response()->json([
            'message' => "Prodi \"{$prodi->nama}\" berhasil ditambahkan.",
            'data'    => $prodi,
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        $this->requireSuperAdmin($request);

        $prodi = Prodi::findOrFail($id);

        $request->validate([
            'nama'     => "required|string|max:255|unique:prodi,nama,{$id}",
            'kode_nim' => 'nullable|string|max:20',
        ], [
            'nama.required' => 'Nama prodi tidak boleh kosong.',
            'nama.unique'   => 'Prodi sudah terdaftar.',
        ]);

        $prodi->update([
            'nama'     => $request->nama,
            'kode_nim' => $request->kode_nim ? strtoupper(trim($request->kode_nim)) : null,
        ]);

        return response()->json([
            'message' => 'Prodi berhasil diperbarui.',
            'data'    => $prodi,
        ]);
    }

    public function destroy(Request $request, int $id)
    {
        $this->requireSuperAdmin($request);

        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return response()->json(['message' => 'Prodi berhasil dihapus.']);
    }

    private function requireSuperAdmin(Request $request): void
    {
        if ($request->user()->role !== 'SuperAdmin') {
            abort(response()->json([
                'message' => 'Hanya SuperAdmin yang dapat mengelola program studi.',
            ], 403));
        }
    }
}
