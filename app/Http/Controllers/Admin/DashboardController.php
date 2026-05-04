<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total alumni terverifikasi
        $totalAlumni = DataAlumni::count();

        // Alumni terserap kerja (jabatan_sekarang terisi)
        $terserapKerja = DataAlumni::whereNotNull('jabatan_sekarang')
            ->where('jabatan_sekarang', '!=', '')
            ->count();

        $persentaseTerserap = $totalAlumni > 0
            ? round(($terserapKerja / $totalAlumni) * 100, 1)
            : 0;

        // Data grafik: jumlah alumni per tahun lulus
        $grafikRaw = DataAlumni::whereNotNull('tahun_lulus')
            ->select(DB::raw('YEAR(tahun_lulus) as tahun'), DB::raw('COUNT(*) as jumlah'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get()
            ->keyBy('tahun');

        $tahunSekarang = now()->year;

        // Isi tahun yang kosong dengan 0, selalu sampai tahun sekarang
        $grafik = collect();
        if ($grafikRaw->isNotEmpty()) {
            $tahunMin = $grafikRaw->keys()->min();
        } else {
            $tahunMin = $tahunSekarang;
        }

        for ($tahun = $tahunMin; $tahun <= $tahunSekarang; $tahun++) {
            $grafik->push((object)[
                'tahun'  => $tahun,
                'jumlah' => $grafikRaw->has($tahun) ? $grafikRaw[$tahun]->jumlah : 0,
            ]);
        }

        // Nilai maksimum untuk skala bar chart
        $maxJumlah = $grafik->max('jumlah') ?: 1;

        return response(view('Admin.dashboard', compact(
            'totalAlumni',
            'terserapKerja',
            'persentaseTerserap',
            'grafik',
            'maxJumlah'
        )))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }
}
