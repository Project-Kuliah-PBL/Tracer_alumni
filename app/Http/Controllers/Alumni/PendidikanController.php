<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPendidikan;
use App\Models\DataAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendidikanController extends Controller
{
    /**
     * Tampilkan daftar riwayat pendidikan alumni.
     */
    public function index()
    {
        $nim        = Auth::user()->username;
        $alumni     = DataAlumni::where('nim', $nim)->firstOrFail();
        $educations = RiwayatPendidikan::where('nim', $nim)
            ->orderBy('tahun_masuk', 'desc')
            ->get();

        return response(view('Alumni.edit_riwayat_pendidikan', compact('alumni', 'educations')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Tampilkan form tambah riwayat pendidikan.
     */
    public function create()
    {
        $nim   = Auth::user()->username;
        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();

        return response(view('Alumni.tambah_riwayat_pendidikan', compact('alumni')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Simpan riwayat pendidikan baru.
     */
    public function store(Request $request)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_instansi'      => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|string|max:100',
            'jurusan'            => 'nullable|string|max:255',
            'tahun_masuk'        => 'nullable|date',
            'tahun_keluar'       => 'nullable|date|after_or_equal:tahun_masuk',
            'nilai_akhir'        => 'nullable|numeric|min:0|max:4',
            'judul_skripsi'      => 'nullable|string|max:500',
        ], [
            'nama_instansi.required'      => 'Nama instansi tidak boleh kosong.',
            'jenjang_pendidikan.required' => 'Jenjang pendidikan tidak boleh kosong.',
            'tahun_keluar.after_or_equal' => 'Tahun keluar tidak boleh sebelum tahun masuk.',
            'nilai_akhir.max'             => 'Nilai akhir maksimal 4.00.',
        ]);

        RiwayatPendidikan::create(array_merge(
            $request->only([
                'nama_instansi', 'jenjang_pendidikan', 'jurusan',
                'tahun_masuk', 'tahun_keluar', 'nilai_akhir', 'judul_skripsi',
            ]),
            ['nim' => $nim]
        ));

        return redirect()->route('alumni.pendidikan.index')
            ->with('success', 'Riwayat pendidikan berhasil ditambahkan.');
    }

    /**
     * Update riwayat pendidikan.
     */
    public function update(Request $request, int $id)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_instansi'      => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|string|max:100',
            'jurusan'            => 'nullable|string|max:255',
            'tahun_masuk'        => 'nullable|date',
            'tahun_keluar'       => 'nullable|date|after_or_equal:tahun_masuk',
            'nilai_akhir'        => 'nullable|numeric|min:0|max:4',
            'judul_skripsi'      => 'nullable|string|max:500',
        ], [
            'nama_instansi.required'      => 'Nama instansi tidak boleh kosong.',
            'jenjang_pendidikan.required' => 'Jenjang pendidikan tidak boleh kosong.',
            'tahun_keluar.after_or_equal' => 'Tahun keluar tidak boleh sebelum tahun masuk.',
        ]);

        $pendidikan = RiwayatPendidikan::where('id', $id)->where('nim', $nim)->firstOrFail();

        $pendidikan->update($request->only([
            'nama_instansi', 'jenjang_pendidikan', 'jurusan',
            'tahun_masuk', 'tahun_keluar', 'nilai_akhir', 'judul_skripsi',
        ]));

        return redirect()->route('alumni.pendidikan.index')
            ->with('success', 'Riwayat pendidikan berhasil diperbarui.');
    }

    /**
     * Hapus riwayat pendidikan.
     */
    public function destroy(int $id)
    {
        $nim        = Auth::user()->username;
        $pendidikan = RiwayatPendidikan::where('id', $id)->where('nim', $nim)->firstOrFail();
        $pendidikan->delete();

        return redirect()->route('alumni.pendidikan.index')
            ->with('success', 'Riwayat pendidikan berhasil dihapus.');
    }
}
