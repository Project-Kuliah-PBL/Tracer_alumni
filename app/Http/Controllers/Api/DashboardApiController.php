<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardApiController extends Controller
{
    public function index(Request $request)
    {
        $user         = $request->user();
        $isSuperAdmin = $user->role === 'SuperAdmin';
        $prodiFilter  = $isSuperAdmin ? null : $user->prodi;

        // ── Statistik Kartu ────────────────────────────────────────────
        $totalAlumni = DataAlumni::when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->count();

        $terserapKerja = DataAlumni::whereHas('pekerjaan')
            ->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->count();

        $persentaseTerserap = $totalAlumni > 0
            ? round(($terserapKerja / $totalAlumni) * 100, 1)
            : 0;

        // ── Grafik Pertumbuhan Alumni per Angkatan ─────────────────────
        $grafikRaw = DataAlumni::whereNotNull('angkatan')
            ->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->select('angkatan as tahun', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'asc')
            ->get()
            ->keyBy('tahun');

        $grafik = [];
        if ($grafikRaw->isNotEmpty()) {
            $tahunMin = (int) $grafikRaw->keys()->min();
            $tahunMax = (int) $grafikRaw->keys()->max();
            for ($tahun = $tahunMin; $tahun <= $tahunMax; $tahun++) {
                $grafik[] = [
                    'tahun'  => $tahun,
                    'jumlah' => $grafikRaw->has($tahun) ? (int) $grafikRaw[$tahun]->jumlah : 0,
                ];
            }
        }

        // ── Grafik Masa Tunggu Kerja ────────────────────────────────────
        $alumniDenganTunggu = DataAlumni::whereNotNull('lama_tunggu_kerja')
            ->where('lama_tunggu_kerja', '!=', '')
            ->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->pluck('lama_tunggu_kerja');

        $kurangSatuTahun = 0;
        $satuDuaTahun    = 0;
        $lebihDuaTahun   = 0;

        foreach ($alumniDenganTunggu as $str) {
            $bulan = $this->parseLamaTungguKeBulan($str);
            if ($bulan === null) continue;
            if ($bulan < 12)      $kurangSatuTahun++;
            elseif ($bulan <= 24) $satuDuaTahun++;
            else                  $lebihDuaTahun++;
        }

        $masaTunggu = [
            ['label' => '< 1 Tahun',   'jumlah' => $kurangSatuTahun],
            ['label' => '1 - 2 Tahun', 'jumlah' => $satuDuaTahun],
            ['label' => '> 2 Tahun',   'jumlah' => $lebihDuaTahun],
        ];

        // ── Grafik Rata-rata Masa Kerja per Angkatan ────────────────────
        $pekerjaanData = DataPekerjaan::join('data_alumni', 'data_pekerjaan.nim', '=', 'data_alumni.nim')
            ->whereNotNull('data_pekerjaan.tahun_masuk')
            ->whereNotNull('data_alumni.angkatan')
            ->when($prodiFilter, fn($q) => $q->where('data_alumni.prodi', $prodiFilter))
            ->select(
                'data_pekerjaan.nim',
                'data_alumni.angkatan',
                'data_pekerjaan.tahun_masuk',
                'data_pekerjaan.tahun_selesai'
            )
            ->get();

        $durasiPerAlumni = [];
        foreach ($pekerjaanData as $p) {
            $mulai   = Carbon::parse($p->tahun_masuk)->startOfMonth();
            $selesai = $p->tahun_selesai
                ? Carbon::parse($p->tahun_selesai)->startOfMonth()
                : now()->startOfMonth();
            $durasi  = max(0, $mulai->diffInMonths($selesai));

            if (! isset($durasiPerAlumni[$p->nim])) {
                $durasiPerAlumni[$p->nim] = ['angkatan' => (int) $p->angkatan, 'durasi' => []];
            }
            $durasiPerAlumni[$p->nim]['durasi'][] = $durasi;
        }

        $rataPerAngkatan = [];
        foreach ($durasiPerAlumni as $data) {
            $angkatan              = $data['angkatan'];
            $rataAlumni            = array_sum($data['durasi']) / count($data['durasi']);
            $rataPerAngkatan[$angkatan][] = $rataAlumni;
        }

        ksort($rataPerAngkatan);
        $masaKerja = [];
        foreach ($rataPerAngkatan as $angkatan => $nilaiAlumni) {
            $masaKerja[] = [
                'angkatan'  => (string) $angkatan,
                'rata_tahun' => round(array_sum($nilaiAlumni) / count($nilaiAlumni) / 12, 1),
            ];
        }

        return response()->json([
            'total_alumni'        => $totalAlumni,
            'terserap_kerja'      => $terserapKerja,
            'persentase_terserap' => $persentaseTerserap,
            'grafik_alumni'       => $grafik,
            'masa_tunggu'         => $masaTunggu,
            'masa_kerja'          => $masaKerja,
        ]);
    }

    private function parseLamaTungguKeBulan(string $str): ?int
    {
        $str   = strtolower(trim($str));
        $total = 0;
        $found = false;

        if (preg_match('/(\d+)\s*(tahun|year)/i', $str, $m)) {
            $total += (int) $m[1] * 12;
            $found  = true;
        }
        if (preg_match('/(\d+)\s*(bulan|month)/i', $str, $m)) {
            $total += (int) $m[1];
            $found  = true;
        }
        if ($found)                              return $total;
        if (preg_match('/^(\d+)$/', $str, $m))  return (int) $m[1];
        if (str_contains($str, 'kurang'))        return 0;

        return null;
    }
}
