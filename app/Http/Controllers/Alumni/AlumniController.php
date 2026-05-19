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
        // Data untuk filter dropdown
        $tahunList = DataAlumni::whereNotNull('tahun_lulus')
                        ->where('tahun_lulus', '>', 0)
                        ->distinct()
                        ->orderByDesc('tahun_lulus')
                        ->pluck('tahun_lulus');

    $prodiList = DataAlumni::whereNotNull('prodi')
                    ->where('prodi', '<>', '')
                    ->distinct()
                    ->orderBy('prodi')
                    ->pluck('prodi');
                    
    $lokasiList = DataPekerjaan::whereNotNull('lokasi')
                    ->where('lokasi', '<>', '')
                    ->distinct()
                    ->orderBy('lokasi')
                    ->pluck('lokasi');

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
                $q2->where('lokasi', $request->lokasi);
            });
        })
        ->paginate(12);

        return view('carialumni', compact('alumnis', 'tahunList', 'prodiList', 'lokasiList'));
    }

    /**
     * Halaman detail biodata alumni (publik).
     */
    public function show(string $nim)
{
    $alumni = DataAlumni::with([
        'pekerjaan' => function ($q) {
            // Aktif dulu, lalu terbaru — konsisten dengan index()
            $q->orderByRaw('CASE WHEN tahun_selesai IS NULL THEN 0 ELSE 1 END ASC')
              ->orderByDesc('tahun_masuk');
        },
        'riwayatPendidikan' => function ($q) {
            $q->orderByDesc('tahun_masuk');
        },
        'sertifikasi' => function ($q) {
            $q->orderByDesc('tanggal_terbit');
        },
        'mediaSosial',
    ])->where('nim', $nim)->firstOrFail();

    $exp = $alumni->pekerjaan;

    $activeJobs = $exp->filter(function ($job) {
        return is_null($job->tahun_selesai) || $job->status_pekerjaan === 'active';
    });

    $totalPekerjaan    = $exp->count();
    $totalActiveJobs   = $activeJobs->count();

    // ✅ Tambahan: ambil pekerjaan terbaru/aktif untuk hero card
    $pekerjaanTerbaru  = $alumni->currentPekerjaan();

    $riwayat_pendidikan = $alumni->riwayatPendidikan;
    $sertifikasi        = $alumni->sertifikasi;
    $medsos             = $alumni->mediaSosial;

    return view('biodataalumni', compact(
        'alumni',
        'exp',
        'totalPekerjaan',
        'totalActiveJobs',
        'activeJobs',
        'pekerjaanTerbaru',   // ✅ tambahkan ini
        'riwayat_pendidikan',
        'sertifikasi',
        'medsos',
    ));
}

    /**
     * Mendapatkan pekerjaan terbaru/aktif untuk seorang alumni.
     * Bisa digunakan via AJAX jika diperlukan.
     */
    public function getCurrentJob($nim)
    {
        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();
        
        $PekerjaanTerbaru = $alumni->currentPekerjaan();
        $activeCount = $alumni->activePekerjaan()->count();
        
        return response()->json([
            'success' => true,
            'data' => [
                'current_job' => $PekerjaanTerbaru ? [
                    'jobdesk' => $PekerjaanTerbaru->jobdesk,
                    'company' => $PekerjaanTerbaru->nama_perusahaan,
                    'status' => $PekerjaanTerbaru->status_pekerjaan,
                    'start_date' => $PekerjaanTerbaru->tahun_masuk?->format('M Y'),
                ] : null,
                'active_jobs_count' => $activeCount,
                'has_multiple_jobs' => $activeCount > 1,
            ]
        ]);
    }
}