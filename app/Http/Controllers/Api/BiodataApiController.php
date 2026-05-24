<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\LamaTungguHelper;
use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use App\Models\RiwayatPendidikan;

class BiodataApiController extends Controller
{
    
    public function index(Request $request)
    {
        $user        = $request->user();
        $isSuperAdmin = $user->role === 'SuperAdmin';
        $prodiFilter  = $isSuperAdmin ? null : $user->prodi;
        $search       = $request->get('search');
        $perPage      = min((int) $request->get('per_page', 15), 50);

        $paginated = DataAlumni::when($search, function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            })
            ->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->orderBy('nama')
            ->paginate($perPage);

        return response()->json([
            'data'         => $paginated->items(),
            'total'        => $paginated->total(),
            'current_page' => $paginated->currentPage(),
            'last_page'    => $paginated->lastPage(),
            'per_page'     => $paginated->perPage(),
        ]);
    }

    
    public function show(Request $request, string $nim)
    {
        $user         = $request->user();
        $isSuperAdmin = $user->role === 'SuperAdmin';

        $alumni = DataAlumni::with(['pekerjaan', 'riwayatPendidikan'])
            ->where('nim', $nim)
            ->when(! $isSuperAdmin, fn($q) => $q->where('prodi', $user->prodi))
            ->firstOrFail();

        return response()->json($alumni);
    }

    public function storePekerjaan(Request $request, string $nim)
    {
        $this->getAllowedAlumni($request, $nim);

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

        $pekerjaan = DataPekerjaan::create([
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

        return response()->json([
            'message' => 'Pekerjaan berhasil ditambahkan.',
            'data'    => $pekerjaan,
        ], 201);
    }

    public function destroyPekerjaan(Request $request, string $nim, int $id)
    {
        $this->getAllowedAlumni($request, $nim);

        DataPekerjaan::where('id', $id)->where('nim', $nim)->firstOrFail()->delete();

        LamaTungguHelper::hitung($nim);

        return response()->json(['message' => 'Pekerjaan berhasil dihapus.']);
    }

    public function storePendidikan(Request $request, string $nim)
    {
        $this->getAllowedAlumni($request, $nim);

        $request->validate([
            'nama_instansi'      => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|string',
            'jurusan'            => 'nullable|string|max:255',
            'tahun_masuk'        => 'nullable|date',
            'tahun_keluar'       => 'nullable|date',
            'nilai_akhir'        => 'nullable|numeric|min:0|max:4',
            'judul_skripsi'      => 'nullable|string',
        ]);

        $pendidikan = RiwayatPendidikan::create([
            'nim'                => $nim,
            'nama_instansi'      => $request->nama_instansi,
            'jenjang_pendidikan' => $request->jenjang_pendidikan,
            'jurusan'            => $request->jurusan,
            'tahun_masuk'        => $request->tahun_masuk,
            'tahun_keluar'       => $request->tahun_keluar,
            'nilai_akhir'        => $request->nilai_akhir,
            'judul_skripsi'      => $request->judul_skripsi,
        ]);

        return response()->json([
            'message' => 'Riwayat pendidikan berhasil ditambahkan.',
            'data'    => $pendidikan,
        ], 201);
    }

   
    public function destroyPendidikan(Request $request, string $nim, int $id)
    {
        $this->getAllowedAlumni($request, $nim);

        RiwayatPendidikan::where('id', $id)->where('nim', $nim)->firstOrFail()->delete();

        return response()->json(['message' => 'Riwayat pendidikan berhasil dihapus.']);
    }

    
    private function getAllowedAlumni(Request $request, string $nim): DataAlumni
    {
        $user = $request->user();

        return DataAlumni::where('nim', $nim)
            ->when($user->role !== 'SuperAdmin', fn($q) => $q->where('prodi', $user->prodi))
            ->firstOrFail();
    }
}
