<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Halaman daftar / pencarian alumni (publik).
     */
public function index(Request $request)
{
    // Cache filter options 10 menit — data ini jarang berubah
    [$tahunList, $prodiList, $lokasiList] = cache()->remember('alumni_filter_options', now()->addMinutes(10), function () {
        return [
            DataAlumni::whereNotNull('tahun_lulus')
                ->where('tahun_lulus', '>', 0)
                ->distinct()->orderByDesc('tahun_lulus')->pluck('tahun_lulus'),
            DataAlumni::whereNotNull('prodi')
                ->where('prodi', '<>', '')
                ->distinct()->orderBy('prodi')->pluck('prodi'),
            DataPekerjaan::whereNotNull('lokasi')
                ->where('lokasi', '<>', '')
                ->distinct()->orderBy('lokasi')->pluck('lokasi'),
        ];
    });

    $alumnis = DataAlumni::with(['pekerjaan' => function ($q) {
            $q->orderByDesc('tahun_masuk');
        }])
        ->when($request->filled('search'), function ($q) use ($request) {
            $search = '%' . $request->search . '%';
            $q->where(function ($q2) use ($search) {
                // 1. Search di tabel Alumni (nama, nim, jabatan)
                $q2->where('nama', 'like', $search)
                   ->orWhere('nim', 'like', $search) // <-- Menambahkan pencarian NIM
                   
                   
                // 2. Search di tabel Pekerjaan (lokasi, perusahaan, status, jobdesk)
                   ->orWhereHas('pekerjaan', function ($q3) use ($search) {
                       $q3->where('lokasi', 'like', $search)
                          ->orWhere('nama_perusahaan', 'like', $search)
                          ->orWhere('status_pekerjaan', 'like', $search)
                          ->orWhere('jobdesk', 'like', $search); // <-- Menambahkan pencarian Jobdesk
                   });
            });
        })
        ->when($request->filled('tahun_lulus'), function ($q) use ($request) {
            $q->where('tahun_lulus', $request->tahun_lulus);
        })
        ->when($request->filled('program_studi'), function ($q) use ($request) {
            $q->where('prodi', $request->program_studi);
        })
        ->when($request->filled('lokasi'), function ($q) use ($request) {
            $q->whereHas('pekerjaan', function ($q2) use ($request) {
                $q2->where('lokasi_pekerjaan', $request->lokasi);
            });
        })
        ->paginate(12);

    return view('carialumni', compact('alumnis', 'tahunList', 'prodiList', 'lokasiList'));
}

        // Ambil profile alumni yang sedang login
// sesuaikan dengan relasi Anda
        
 

    /**
     * Halaman detail biodata alumni (publik).
     */
    public function show(string $nim)
    {
        $alumni = DataAlumni::with([
            'pekerjaan',
            'riwayatPendidikan',
            'sertifikasi',
            'mediaSosial',
        ])->where('nim', $nim)->firstOrFail();

        $exp                = $alumni->pekerjaan;
        $riwayat_pendidikan = $alumni->riwayatPendidikan;
        $sertifikasi        = $alumni->sertifikasi;
        $medsos             = $alumni->mediaSosial;

        return view('biodataalumni', compact(
            'alumni',
            'exp',
            'riwayat_pendidikan',
            'sertifikasi',
            'medsos',
        ));
    }
}