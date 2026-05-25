<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use App\Models\RiwayatPendidikan;
use App\Helpers\LamaTungguHelper;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    // Daftar semua alumni
    public function index(Request $request)
    {
        $search = $request->get('search');
        $isSuperAdmin = auth()->user()->role === 'SuperAdmin';
        $prodiFilter  = $isSuperAdmin ? null : auth()->user()->prodi;

        $alumni = DataAlumni::when($search, function ($query) use ($search) {
            $query->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
        })->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
          ->orderBy('nama')->paginate(15)->withQueryString();

        return view('Admin.editbiodata', compact('alumni', 'search'));
    }

    // Detail biodata satu alumni
    public function show(string $nim)
    {
        $query = DataAlumni::with(['pekerjaan', 'riwayatPendidikan'])->where('nim', $nim);

        if (auth()->user()->role !== 'SuperAdmin') {
            $query->where('prodi', auth()->user()->prodi);
        }

        $alumni = $query->firstOrFail();

        return view('Admin.biodata', compact('alumni'));
    }

    // Simpan pekerjaan baru
    public function storePekerjaan(Request $request, string $nim)
    {
        $this->getAllowedAlumni($nim);

        $request->validate([
            'jobdesk'          => 'required|string|max:255',
            'nama_perusahaan'  => 'required|string|max:255',
            'status_pekerjaan' => 'required|string',
            'divisi'           => 'nullable|string|max:255',
            'lokasi'           => 'nullable|string|max:255',
            'tahun_masuk'      => 'nullable|date',
            'tahun_selesai'    => 'nullable|date',
            'deskripsi'        => 'nullable|string',
        ]);

        DataPekerjaan::create([
            'nim'              => $nim,
            'jobdesk'          => $request->jobdesk,
            'nama_perusahaan'  => $request->nama_perusahaan,
            'status_pekerjaan' => $request->status_pekerjaan,
            'divisi'           => $request->divisi,
            'lokasi'           => $request->lokasi,
            'tahun_masuk'      => $request->tahun_masuk,
            'tahun_selesai'    => $request->tahun_selesai,
            'deskripsi'        => $request->deskripsi,
        ]);

        LamaTungguHelper::hitung($nim);
        cache()->forget('alumni_filter_options');
        return redirect()->route('admin.biodata', $nim)->with('success', 'Pekerjaan berhasil ditambahkan.');
        
    }

    // Hapus pekerjaan
    public function destroyPekerjaan(string $nim, int $id)
    {
        $this->getAllowedAlumni($nim);

        DataPekerjaan::where('id', $id)->where('nim', $nim)->delete();

        LamaTungguHelper::hitung($nim);
            cache()->forget('alumni_filter_options');
            return redirect()->route('admin.biodata', $nim)->with('success', 'Pekerjaan berhasil dihapus.');
                
    }

    // Simpan pendidikan baru
    public function storePendidikan(Request $request, string $nim)
    {
        $this->getAllowedAlumni($nim);

        $request->validate([
            'nama_instansi'      => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|string',
            'jurusan'            => 'nullable|string|max:255',
            'tahun_masuk'        => 'nullable|date',
            'tahun_keluar'       => 'nullable|date',
            'nilai_akhir'        => 'nullable|numeric|min:0|max:4',
            'judul_skripsi'      => 'nullable|string',
        ]);

        RiwayatPendidikan::create([
            'nim'                => $nim,
            'nama_instansi'      => $request->nama_instansi,
            'jenjang_pendidikan' => $request->jenjang_pendidikan,
            'jurusan'            => $request->jurusan,
            'tahun_masuk'        => $request->tahun_masuk,
            'tahun_keluar'       => $request->tahun_keluar,
            'nilai_akhir'        => $request->nilai_akhir,
            'judul_skripsi'      => $request->judul_skripsi,
        ]);

        cache()->forget('alumni_filter_options');

        return redirect()->route('admin.biodata', $nim)->with('success', 'Pendidikan berhasil ditambahkan.');
    }

    // Hapus pendidikan
    public function destroyPendidikan(string $nim, int $id)
    {
        $this->getAllowedAlumni($nim);

        RiwayatPendidikan::where('id', $id)->where('nim', $nim)->delete();

        cache()->forget('alumni_filter_options');

        return redirect()->route('admin.biodata', $nim)->with('success', 'Pendidikan berhasil dihapus.');
    }

    private function getAllowedAlumni(string $nim)
    {
        $query = DataAlumni::where('nim', $nim);

        if (auth()->user()->role !== 'SuperAdmin') {
            $query->where('prodi', auth()->user()->prodi);
        }

        return $query->firstOrFail();
    }
}
