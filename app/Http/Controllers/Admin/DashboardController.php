<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Card statistik ──────────────────────────────────────────
        $totalAlumni = DataAlumni::count();

        $terserapKerja = DataAlumni::whereNotNull('jabatan_sekarang')
            ->where('jabatan_sekarang', '!=', '')
            ->count();

        $persentaseTerserap = $totalAlumni > 0
            ? round(($terserapKerja / $totalAlumni) * 100, 1)
            : 0;

        // ── Grafik pertumbuhan alumni per tahun lulus ────────────────
        $grafikRaw = DataAlumni::whereNotNull('tahun_lulus')
            ->select(DB::raw('YEAR(tahun_lulus) as tahun'), DB::raw('COUNT(*) as jumlah'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get()
            ->keyBy('tahun');

        $tahunSekarang = now()->year;
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

        // ── Grafik masa tunggu kerja (kategorisasi dari lama_tunggu_kerja) ──
        // lama_tunggu_kerja disimpan sebagai string, contoh: "3 Bulan", "1 Tahun", "18 Bulan"
        // Konversi ke bulan lalu kategorikan
        $alumniDenganTunggu = DataAlumni::whereNotNull('lama_tunggu_kerja')
            ->where('lama_tunggu_kerja', '!=', '')
            ->get(['lama_tunggu_kerja']);

        $kurangSatuTahun = 0;
        $satuDuaTahun    = 0;
        $lebihDuaTahun   = 0;

        foreach ($alumniDenganTunggu as $a) {
            $bulan = $this->parseLamaTungguKeBulan($a->lama_tunggu_kerja);
            if ($bulan === null) continue;

            if ($bulan < 12) {
                $kurangSatuTahun++;
            } elseif ($bulan <= 24) {
                $satuDuaTahun++;
            } else {
                $lebihDuaTahun++;
            }
        }

        $masaTunggu = collect([
            (object)['label' => '< 1 Tahun',   'jumlah' => $kurangSatuTahun],
            (object)['label' => '1 - 2 Tahun', 'jumlah' => $satuDuaTahun],
            (object)['label' => '> 2 Tahun',   'jumlah' => $lebihDuaTahun],
        ]);

        // ── Grafik masa kerja rata-rata per angkatan ─────────────────
        // Ambil semua pekerjaan yang punya tahun_masuk
        // Hitung durasi kerja tiap pekerjaan (dalam tahun)
        // Rata-rata per angkatan (tahun_lulus alumni)
        $pekerjaanData = DataPekerjaan::whereNotNull('tahun_masuk')
            ->join('data_alumni', 'data_pekerjaan.nim', '=', 'data_alumni.nim')
            ->whereNotNull('data_alumni.tahun_lulus')
            ->select(
                DB::raw('YEAR(data_alumni.tahun_lulus) as angkatan'),
                'data_pekerjaan.tahun_masuk',
                'data_pekerjaan.tahun_selesai'
            )
            ->get();

        // Hitung durasi per pekerjaan lalu rata-rata per angkatan
        $durasiPerAngkatan = [];
        foreach ($pekerjaanData as $p) {
            $mulai   = \Carbon\Carbon::parse($p->tahun_masuk);
            $selesai = $p->tahun_selesai ? \Carbon\Carbon::parse($p->tahun_selesai) : now();
            $durasi  = $mulai->diffInMonths($selesai) / 12; // dalam tahun

            $angkatan = $p->angkatan;
            if (!isset($durasiPerAngkatan[$angkatan])) {
                $durasiPerAngkatan[$angkatan] = [];
            }
            $durasiPerAngkatan[$angkatan][] = $durasi;
        }

        // Rata-rata per angkatan, isi 0 untuk angkatan tanpa data
        $masaKerjaLabels = [];
        $masaKerjaData   = [];

        if (!empty($durasiPerAngkatan)) {
            $angkatanMin = min(array_keys($durasiPerAngkatan));
            $angkatanMax = max(array_keys($durasiPerAngkatan));

            for ($y = $angkatanMin; $y <= $angkatanMax; $y++) {
                $masaKerjaLabels[] = (string) $y;
                if (isset($durasiPerAngkatan[$y]) && count($durasiPerAngkatan[$y]) > 0) {
                    $masaKerjaData[] = round(array_sum($durasiPerAngkatan[$y]) / count($durasiPerAngkatan[$y]), 2);
                } else {
                    $masaKerjaData[] = 0;
                }
            }
        }

        return response(view('Admin.dashboard', compact(
            'totalAlumni',
            'terserapKerja',
            'persentaseTerserap',
            'grafik',
            'masaTunggu',
            'masaKerjaLabels',
            'masaKerjaData'
        )))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Parse string lama tunggu kerja ke satuan bulan.
     * Contoh: "3 Bulan" → 3, "1 Tahun" → 12, "18 Bulan" → 18, "1.5 Tahun" → 18
     */
    private function parseLamaTungguKeBulan(string $str): ?int
    {
        $str = strtolower(trim($str));

        // Coba cocokkan angka + satuan
        if (preg_match('/(\d+\.?\d*)\s*(bulan|month)/i', $str, $m)) {
            return (int) round((float) $m[1]);
        }
        if (preg_match('/(\d+\.?\d*)\s*(tahun|year)/i', $str, $m)) {
            return (int) round((float) $m[1] * 12);
        }
        // Hanya angka (asumsikan bulan)
        if (preg_match('/^(\d+)$/', $str, $m)) {
            return (int) $m[1];
        }

        return null;
    }
}
