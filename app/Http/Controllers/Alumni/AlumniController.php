<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Halaman daftar / pencarian alumni (publik).
     */
public function index(Request $request)
{
    $query = DataAlumni::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('jabatan_sekarang', 'like', "%{$search}%")
              ->orWhere('alamat', 'like', "%{$search}%");
            // Hapus prodi & tahun_lulus dari search karena prodi=null & tahun_lulus integer
        });
    }

    if ($request->filled('tahun_lulus')) {
        // Gunakan YEAR() atau LIKE karena format simpan: 20210508
        $query->where('tahun_lulus', 'like', $request->tahun_lulus . '%');
    }

    if ($request->filled('program_studi')) {
        // prodi di DB = null, skip dulu atau sesuaikan jika sudah ada datanya
        $query->where('prodi', $request->program_studi);
    }

    if ($request->filled('lokasi')) {
        // kolom lokasi tidak ada, di DB namanya 'alamat'
        $query->where('alamat', 'like', "%{$request->lokasi}%");
    }

    $alumnis = $query->paginate(12)->withQueryString();

    return view('carialumni', compact('alumnis'));
}

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
    }
}