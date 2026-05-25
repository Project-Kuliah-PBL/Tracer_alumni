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
        // Cache filter options 10 menit
        [$tahunList, $prodiList, $lokasiList] = cache()->remember(
            'alumni_filter_options',
            now()->addMinutes(10),
            function () {
                return [
                    DataAlumni::whereNotNull('angkatan')
                        ->where('angkatan', '>', 0)
                        ->distinct()
                        ->orderByDesc('angkatan')
                        ->pluck('angkatan'),

                    DataAlumni::whereNotNull('prodi')
                        ->where('prodi', '<>', '')
                        ->distinct()
                        ->orderBy('prodi')
                        ->pluck('prodi'),

                    DataPekerjaan::whereNotNull('lokasi')
                        ->where('lokasi', '<>', '')
                        ->distinct()
                        ->orderBy('lokasi')
                        ->pluck('lokasi'),
                ];
            }
        );

        $alumnis = DataAlumni::with([
                'pekerjaan' => function ($q) {
                    $q->orderByDesc('tahun_masuk');
                }
            ])
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = '%' . $request->search . '%';

                $q->where(function ($q2) use ($search) {
                    $q2->where('nama', 'like', $search)
                        ->orWhere('nim', 'like', $search)
                        ->orWhereHas('pekerjaan', function ($q3) use ($search) {
                            $q3->where('lokasi', 'like', $search)
                                ->orWhere('nama_perusahaan', 'like', $search)
                                ->orWhere('status_pekerjaan', 'like', $search)
                                ->orWhere('jobdesk', 'like', $search);
                        });
                });
            })
            ->when($request->filled('angkatan'), function ($q) use ($request) {
                $q->where('angkatan', $request->angkatan);
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

        return view('carialumni', compact(
            'alumnis',
            'tahunList',
            'prodiList',
            'lokasiList'
        ));
    }

    /**
     * Halaman detail biodata alumni (publik).
     */
    public function show(string $nim)
    {
        $alumni = DataAlumni::with([
            'pekerjaan' => function ($q) {
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
            return is_null($job->tahun_selesai)
                || $job->status_pekerjaan === 'active';
        });

        $totalPekerjaan = $exp->count();
        $totalActiveJobs = $activeJobs->count();

        $pekerjaanTerbaru = $alumni->currentPekerjaan();

        $riwayat_pendidikan = $alumni->riwayatPendidikan;
        $sertifikasi = $alumni->sertifikasi;
        $medsos = $alumni->mediaSosial;

        return view('biodataalumni', compact(
            'alumni',
            'exp',
            'totalPekerjaan',
            'totalActiveJobs',
            'activeJobs',
            'pekerjaanTerbaru',
            'riwayat_pendidikan',
            'sertifikasi',
            'medsos',
        ));
    }

    /**
     * Mendapatkan pekerjaan terbaru/aktif untuk seorang alumni.
     */
    public function getCurrentJob($nim)
    {
        $alumni = DataAlumni::where('nim', $nim)->firstOrFail();

        $pekerjaanTerbaru = $alumni->currentPekerjaan();
        $activeCount = $alumni->activePekerjaan()->count();

        return response()->json([
            'success' => true,
            'data' => [
                'current_job' => $pekerjaanTerbaru ? [
                    'jobdesk' => $pekerjaanTerbaru->jobdesk,
                    'company' => $pekerjaanTerbaru->nama_perusahaan,
                    'status' => $pekerjaanTerbaru->status_pekerjaan,
                    'start_date' => $pekerjaanTerbaru->tahun_masuk?->format('M Y'),
                ] : null,
                'active_jobs_count' => $activeCount,
                'has_multiple_jobs' => $activeCount > 1,
            ]
        ]);
    }
}