<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // ── Grafik pertumbuhan alumni per angkatan ─────────────────

        $grafikRaw = DataAlumni::whereNotNull('angkatan')
            ->select(
                'angkatan as tahun',
                DB::raw('COUNT(*) as jumlah')
            )
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'asc')
            ->get()
            ->keyBy('tahun');

        $grafik = collect();

        if ($grafikRaw->isNotEmpty()) {

            $tahunMin = (int) $grafikRaw->keys()->min();
            $tahunMax = (int) $grafikRaw->keys()->max();

            for ($tahun = $tahunMin; $tahun <= $tahunMax; $tahun++) {

                $grafik->push((object)[
                    'tahun'  => $tahun,
                    'jumlah' => $grafikRaw->has($tahun)
                        ? $grafikRaw[$tahun]->jumlah
                        : 0,
                ]);
            }
        }

        // ── Grafik masa tunggu kerja ───────────────────────────────

        $alumniDenganTunggu = DataAlumni::whereNotNull('lama_tunggu_kerja')
            ->where('lama_tunggu_kerja', '!=', '')
            ->get(['lama_tunggu_kerja']);

        $kurangSatuTahun = 0;
        $satuDuaTahun    = 0;
        $lebihDuaTahun   = 0;

        foreach ($alumniDenganTunggu as $a) {

            $bulan = $this->parseLamaTungguKeBulan(
                $a->lama_tunggu_kerja
            );

            if ($bulan === null) {
                continue;
            }

            if ($bulan < 12) {

                $kurangSatuTahun++;

            } elseif ($bulan <= 24) {

                $satuDuaTahun++;

            } else {

                $lebihDuaTahun++;
            }
        }

        $masaTunggu = collect([
            (object)[
                'label'  => '< 1 Tahun',
                'jumlah' => $kurangSatuTahun
            ],
            (object)[
                'label'  => '1 - 2 Tahun',
                'jumlah' => $satuDuaTahun
            ],
            (object)[
                'label'  => '> 2 Tahun',
                'jumlah' => $lebihDuaTahun
            ],
        ]);

        // ── Grafik masa kerja rata-rata per angkatan ──────────────

        $pekerjaanData = DataPekerjaan::join(
                'data_alumni',
                'data_pekerjaan.nim',
                '=',
                'data_alumni.nim'
            )
            ->whereNotNull('data_alumni.angkatan')
            ->whereNotNull('data_pekerjaan.tahun_masuk')
            ->select(
                'data_alumni.angkatan',
                'data_pekerjaan.tahun_masuk',
                'data_pekerjaan.tahun_selesai'
            )
            ->get();

        $durasiPerAngkatan = [];

        foreach ($pekerjaanData as $p) {

            $mulai = Carbon::parse($p->tahun_masuk);

            $selesai = $p->tahun_selesai
                ? Carbon::parse($p->tahun_selesai)
                : now();

            // Lama kerja dalam bulan
            $durasi = $mulai->diffInMonths($selesai);

            $angkatan = (int) $p->angkatan;

            if (!isset($durasiPerAngkatan[$angkatan])) {
                $durasiPerAngkatan[$angkatan] = [];
            }

            $durasiPerAngkatan[$angkatan][] = $durasi;
        }

        $masaKerjaLabels = [];
        $masaKerjaData   = [];

        if (!empty($durasiPerAngkatan)) {

            ksort($durasiPerAngkatan);

            $angkatanMin = min(array_keys($durasiPerAngkatan));
            $angkatanMax = max(array_keys($durasiPerAngkatan));

            for ($tahun = $angkatanMin; $tahun <= $angkatanMax; $tahun++) {

                $masaKerjaLabels[] = 'Angkatan ' . $tahun;

                if (
                    isset($durasiPerAngkatan[$tahun]) &&
                    count($durasiPerAngkatan[$tahun]) > 0
                ) {

                    $rataRata = array_sum(
                        $durasiPerAngkatan[$tahun]
                    ) / count($durasiPerAngkatan[$tahun]);

                    // Convert bulan → tahun
                    $masaKerjaData[] = round($rataRata / 12, 1);

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
     * Parse lama tunggu kerja ke bulan.
     * Contoh:
     * "3 Bulan" => 3
     * "1 Tahun" => 12
     * "1 Tahun 6 Bulan" => 18
     */

    private function parseLamaTungguKeBulan(string $str): ?int
    {
        $str = strtolower(trim($str));

        $total = 0;
        $found = false;

        // Tahun
        if (preg_match('/(\d+)\s*(tahun|year)/i', $str, $m)) {

            $total += (int)$m[1] * 12;

            $found = true;
        }

        // Bulan
        if (preg_match('/(\d+)\s*(bulan|month)/i', $str, $m)) {

            $total += (int)$m[1];

            $found = true;
        }

        if ($found) {
            return $total;
        }

        // Hanya angka
        if (preg_match('/^(\d+)$/', $str, $m)) {

            return (int)$m[1];
        }

        // Kurang dari 1 bulan
        if (str_contains($str, 'kurang')) {

            return 0;
        }

        return null;
    }
}