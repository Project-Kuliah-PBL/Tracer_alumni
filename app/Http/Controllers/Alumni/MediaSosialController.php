<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\MediaSosial;
use App\Models\DataAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaSosialController extends Controller
{
    /**
     * Tampilkan daftar media sosial alumni.
     * (Biasanya diload via dashboard/profil, bisa juga sebagai standalone)
     */
    public function index()
    {
        $nim       = Auth::user()->username;
        $alumni    = DataAlumni::where('nim', $nim)->firstOrFail();
        $mediaSosial = MediaSosial::where('nim', $nim)->get();

        return response(view('Alumni.dashboard', compact('alumni', 'mediaSosial')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Simpan media sosial baru.
     */
    public function store(Request $request)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_platform' => 'required|string|max:100',
            'link_medsos'   => 'required|url|max:500',
        ], [
            'nama_platform.required' => 'Nama platform tidak boleh kosong.',
            'link_medsos.required'   => 'Link media sosial tidak boleh kosong.',
            'link_medsos.url'        => 'Link media sosial harus berupa URL yang valid (contoh: https://...).',
        ]);

        MediaSosial::create([
            'nim'           => $nim,
            'nama_platform' => $request->nama_platform,
            'link_medsos'   => $request->link_medsos,
        ]);

        return redirect()->back()->with('success', 'Media sosial berhasil ditambahkan.');
    }

    /**
     * Update media sosial.
     */
    public function update(Request $request, int $id)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_platform' => 'required|string|max:100',
            'link_medsos'   => 'required|url|max:500',
        ], [
            'nama_platform.required' => 'Nama platform tidak boleh kosong.',
            'link_medsos.url'        => 'Link media sosial harus berupa URL yang valid.',
        ]);

        $medsos = MediaSosial::where('id', $id)->where('nim', $nim)->firstOrFail();
        $medsos->update($request->only(['nama_platform', 'link_medsos']));

        return redirect()->back()->with('success', 'Media sosial berhasil diperbarui.');
    }

    /**
     * Hapus media sosial.
     */
    public function destroy(int $id)
    {
        $nim    = Auth::user()->username;
        $medsos = MediaSosial::where('id', $id)->where('nim', $nim)->firstOrFail();
        $medsos->delete();

        return redirect()->back()->with('success', 'Media sosial berhasil dihapus.');
    }
}
