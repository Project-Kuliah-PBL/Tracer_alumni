<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataPekerjaan;
use App\Models\DataAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PekerjaanController extends Controller
{
    /**
     * Tampilkan daftar pengalaman kerja alumni yang login.
     */
    public function index()
    {
        $nim        = Auth::user()->username;
        $alumni     = DataAlumni::where('nim', $nim)->firstOrFail();
        $experiences = DataPekerjaan::where('nim', $nim)
            ->orderBy('tahun_masuk', 'desc')
            ->get();

        return response(view('Alumni.edit_pengalaman_kerja', compact('alumni', 'experiences')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Tampilkan form tambah pengalaman kerja.
     */
    public function create()
    {
        $nim   = Auth::user()->username;
        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();

        return response(view('Alumni.tambah_pekerjaan', compact('alumni')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Simpan pengalaman kerja baru.
     */
    public function store(Request $request)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_perusahaan'  => 'required|string|max:255',
            'status_pekerjaan' => 'required|string|max:100',
            'jobdesk'          => 'nullable|string|max:255',
            'tahun_masuk'      => 'nullable|date',
            'tahun_selesai'    => 'nullable|date|after_or_equal:tahun_masuk',
            'deskripsi'        => 'nullable|string',
            'logo_perusahaan'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ], [
            'nama_perusahaan.required'  => 'Nama perusahaan tidak boleh kosong.',
            'status_pekerjaan.required' => 'Status pekerjaan tidak boleh kosong.',
            'tahun_selesai.after_or_equal' => 'Tahun selesai tidak boleh sebelum tahun masuk.',
            'logo_perusahaan.max'       => 'Logo perusahaan maksimal 1MB.',
        ]);

        $data = $request->only([
            'nama_perusahaan', 'status_pekerjaan', 'jobdesk',
            'tahun_masuk', 'tahun_selesai', 'deskripsi',
        ]);
        $data['nim'] = $nim;

        if ($request->hasFile('logo_perusahaan')) {
            $data['logo_perusahaan'] = $request->file('logo_perusahaan')
                ->store('logo_perusahaan', 'public');
        }

        DataPekerjaan::create($data);

        return redirect()->route('alumni.pekerjaan.index')
            ->with('success', 'Pengalaman kerja berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit pengalaman kerja.
     */
    public function edit(int $id)
    {
        $nim        = Auth::user()->username;
        $alumni     = DataAlumni::where('nim', $nim)->firstOrFail();
        $pekerjaan  = DataPekerjaan::where('id', $id)->where('nim', $nim)->firstOrFail();

        return response(view('Alumni.edit_pengalaman_kerja', compact('alumni', 'pekerjaan')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Perbarui data pengalaman kerja.
     */
    public function update(Request $request, int $id)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_perusahaan'  => 'required|string|max:255',
            'status_pekerjaan' => 'required|string|max:100',
            'jobdesk'          => 'nullable|string|max:255',
            'tahun_masuk'      => 'nullable|date',
            'tahun_selesai'    => 'nullable|date|after_or_equal:tahun_masuk',
            'deskripsi'        => 'nullable|string',
            'logo_perusahaan'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ], [
            'nama_perusahaan.required'     => 'Nama perusahaan tidak boleh kosong.',
            'status_pekerjaan.required'    => 'Status pekerjaan tidak boleh kosong.',
            'tahun_selesai.after_or_equal' => 'Tahun selesai tidak boleh sebelum tahun masuk.',
        ]);

        $pekerjaan = DataPekerjaan::where('id', $id)->where('nim', $nim)->firstOrFail();

        $data = $request->only([
            'nama_perusahaan', 'status_pekerjaan', 'jobdesk',
            'tahun_masuk', 'tahun_selesai', 'deskripsi',
        ]);

        if ($request->hasFile('logo_perusahaan')) {
            if ($pekerjaan->logo_perusahaan) {
                Storage::disk('public')->delete($pekerjaan->logo_perusahaan);
            }
            $data['logo_perusahaan'] = $request->file('logo_perusahaan')
                ->store('logo_perusahaan', 'public');
        }

        $pekerjaan->update($data);

        return redirect()->route('alumni.pekerjaan.index')
            ->with('success', 'Pengalaman kerja berhasil diperbarui.');
    }

    /**
     * Hapus data pengalaman kerja.
     */
    public function destroy(int $id)
    {
        $nim       = Auth::user()->username;
        $pekerjaan = DataPekerjaan::where('id', $id)->where('nim', $nim)->firstOrFail();

        if ($pekerjaan->logo_perusahaan) {
            Storage::disk('public')->delete($pekerjaan->logo_perusahaan);
        }

        $pekerjaan->delete();

        return redirect()->route('alumni.pekerjaan.index')
            ->with('success', 'Pengalaman kerja berhasil dihapus.');
    }
}
