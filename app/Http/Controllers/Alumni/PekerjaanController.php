<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataPekerjaan;
use App\Models\DataAlumni;
use App\Helpers\LamaTungguHelper;
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

        return view('Alumni.edit_pengalaman_kerja', compact('alumni', 'experiences'));
    }

    /**
     * Tampilkan form tambah pengalaman kerja.
     */
    public function create()
    {
        $nim   = Auth::user()->username;
        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();

        return view('Alumni.tambah_pekerjaan', compact('alumni'));
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
            'deskripsi'        => 'nullable|string|max:2000',
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

        LamaTungguHelper::hitung($nim);

        return redirect()->route('alumni.dashboard')
            ->with('success', 'Pengalaman kerja berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit pengalaman kerja.
     */
    public function edit($id)
    {
        $nim    = Auth::user()->username;
        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();
        
        // Ambil data pekerjaan yang akan diedit
        $pekerjaan = DataPekerjaan::where('id', $id)->where('nim', $nim)->firstOrFail();
        
        // Ambil semua data pekerjaan untuk ditampilkan di list
        $experiences = DataPekerjaan::where('nim', $nim)
            ->orderBy('tahun_masuk', 'desc')
            ->get();

        // Kirim kedua variabel ke view
        return view('Alumni.edit_pengalaman_kerja', compact('alumni', 'experiences', 'pekerjaan'));
    }

    /**
     * Perbarui data pengalaman kerja.
     */
    public function update(Request $request, $id)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_perusahaan'  => 'required|string|max:255',
            'status_pekerjaan' => 'required|string|max:100',
            'jobdesk'          => 'nullable|string|max:255',
            'tahun_masuk'      => 'nullable|date',
            'tahun_selesai'    => 'nullable|date|after_or_equal:tahun_masuk',
            'deskripsi'        => 'nullable|string|max:2000',
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

        LamaTungguHelper::hitung($nim);

        return redirect()->route('alumni.pekerjaan.index')
            ->with('success', 'Pengalaman kerja berhasil diperbarui.');
    }

    /**
     * Hapus data pengalaman kerja.
     */
    public function destroy($id)
    {
        $nim       = Auth::user()->username;
        $pekerjaan = DataPekerjaan::where('id', $id)->where('nim', $nim)->firstOrFail();

        if ($pekerjaan->logo_perusahaan) {
            Storage::disk('public')->delete($pekerjaan->logo_perusahaan);
        }

        $pekerjaan->delete();

        LamaTungguHelper::hitung($nim);

        return redirect()->route('alumni.pekerjaan.index')
            ->with('success', 'Pengalaman kerja berhasil dihapus.');
    }
}