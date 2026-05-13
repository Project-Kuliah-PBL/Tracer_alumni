<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Halaman daftar / pencarian alumni (publik).
     */
public function index(Request $request)
{
    // Ambil opsi filter DINAMIS dari database
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
                    
    $lokasiList = DataPekerjaan::whereNotNull('lokasi_pekerjaan')
                    ->where('lokasi_pekerjaan', '<>', '')
                    ->distinct()
                    ->orderBy('lokasi_pekerjaan')
                    ->pluck('lokasi_pekerjaan');

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
                       $q3->where('lokasi_pekerjaan', 'like', $search)
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
        // ✅ FIX: gunakan where+firstOrFail jika 'nim' bukan primary key integer default
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

        $pekerjaanAktif = $alumni->pekerjaan()
            ->where(function($query) {
                $query->whereNull('tahun_selesai')  // Tidak ada tanggal selesai
                      ->orWhere('tahun_selesai', '>=', now());  // Atau selesai di masa depan
            })
            ->latest('tahun_masuk')  // Ambil yang paling baru
            ->first();
        
        // Fallback: jika tidak ada pekerjaan aktif, ambil pekerjaan terakhir saja
        $pekerjaanTerbaru = $pekerjaanAktif ?? $alumni->pekerjaan()
            ->latest('tahun_masuk')
            ->first();
        
        return view('alumni.dashboard', [
            'alumni'           => $alumni,
            'pekerjaanTerbaru' => $pekerjaanTerbaru,  // ✅ Pass data ke blade
        ]);
    }
}