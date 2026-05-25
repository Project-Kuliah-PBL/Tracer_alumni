<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataCertificate;
use App\Models\DataAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SertifikasiController extends Controller
{
    /**
     * Tampilkan daftar sertifikasi alumni.
     */
    public function index()
    {
        $nim            = Auth::user()->username;
        $alumni         = DataAlumni::where('nim', $nim)->firstOrFail();
        $certifications = DataCertificate::where('nim', $nim)
            ->orderBy('tanggal_terbit', 'desc')
            ->get();

        return response(view('Alumni.sertifikasi', compact('alumni', 'certifications')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Tampilkan form tambah sertifikasi.
     */
    public function create()
    {
        $nim   = Auth::user()->username;
        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();

        return response(view('Alumni.tambah_pencapaian', compact('alumni')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Simpan sertifikasi baru.
     */
    public function store(Request $request)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama'             => 'required|string|max:255',
            'tanggal_terbit'   => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_terbit',
            'diterbitkan_oleh' => 'nullable|string|max:255',
            'id_kredensial'    => 'nullable|string|max:255',
            'gambar_serti'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama.required'    => 'Nama sertifikasi tidak boleh kosong.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal terbit.',
            'gambar_serti.max' => 'Ukuran gambar sertifikat maksimal 2MB.',
        ]);

        $data = $request->only([
            'nama', 'tanggal_terbit', 'tanggal_berakhir', 'diterbitkan_oleh', 'id_kredensial',
        ]);
        $data['nim'] = $nim;

        if ($request->hasFile('gambar_serti')) {
            $data['gambar_serti'] = $request->file('gambar_serti')
                ->store('sertifikasi', 'public');
        }

        DataCertificate::create($data);
        cache()->forget('alumni_filter_options');
        return redirect()->route('alumni.dashboard')
            ->with('success', 'Sertifikasi berhasil ditambahkan.');
    }

    /**
     * Update sertifikasi.
     */
    public function update(Request $request, int $id)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama'             => 'required|string|max:255',
            'tanggal_terbit'   => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_terbit',
            'diterbitkan_oleh' => 'nullable|string|max:255',
            'id_kredensial'    => 'nullable|string|max:255',
            'gambar_serti'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama.required' => 'Nama sertifikasi tidak boleh kosong.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal terbit.',
        ]);

        $sertifikasi = DataCertificate::where('id', $id)->where('nim', $nim)->firstOrFail();

        $data = $request->only([
            'nama', 'tanggal_terbit', 'tanggal_berakhir', 'diterbitkan_oleh', 'id_kredensial',
        ]);

        if ($request->hasFile('gambar_serti')) {
            if ($sertifikasi->gambar_serti) {
                Storage::disk('public')->delete($sertifikasi->gambar_serti);
            }
            $data['gambar_serti'] = $request->file('gambar_serti')
                ->store('sertifikasi', 'public');
        }

        $sertifikasi->update($data);
        cache()->forget('alumni_filter_options');
        return redirect()->route('alumni.sertifikasi.index')
            ->with('success', 'Sertifikasi berhasil diperbarui.');
    }

    /**
     * Hapus sertifikasi.
     */
    public function destroy(int $id)
    {
        $nim         = Auth::user()->username;
        $sertifikasi = DataCertificate::where('id', $id)->where('nim', $nim)->firstOrFail();

        if ($sertifikasi->gambar_serti) {
            Storage::disk('public')->delete($sertifikasi->gambar_serti);
        }

        $sertifikasi->delete();
        cache()->forget('alumni_filter_options');
        return redirect()->route('alumni.sertifikasi.index')
            ->with('success', 'Sertifikasi berhasil dihapus.');
    }
}
