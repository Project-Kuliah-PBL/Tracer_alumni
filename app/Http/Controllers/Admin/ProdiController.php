<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::orderBy('nama')->get();

        return view('Admin.kelolaprodi', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255|unique:prodi,nama',
            'akreditasi'  => 'nullable|string|max:50',
        ], [
            'nama.required' => 'Nama prodi tidak boleh kosong.',
            'nama.unique'   => 'Prodi sudah terdaftar.',
        ]);

        Prodi::create([
            'nama'       => $request->nama,
            'akreditasi' => $request->akreditasi,
        ]);

        return redirect()->route('admin.prodi')->with('success', "Prodi \"{$request->nama}\" berhasil ditambahkan.");
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama'       => 'required|string|max:255|unique:prodi,nama,' . $prodi->id,
            'akreditasi' => 'nullable|string|max:50',
        ], [
            'nama.required' => 'Nama prodi tidak boleh kosong.',
            'nama.unique'   => 'Prodi sudah terdaftar.',
        ]);

        $prodi->update([
            'nama'       => $request->nama,
            'akreditasi' => $request->akreditasi,
        ]);

        return redirect()->route('admin.prodi')->with('success', "Prodi berhasil diperbarui.");
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        return redirect()->route('admin.prodi')->with('success', "Prodi berhasil dihapus.");
    }
}
