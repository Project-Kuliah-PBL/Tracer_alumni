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
        $user         = auth()->user();
        $isSuperAdmin = $user->role === 'SuperAdmin';
        $prodiFilter  = $isSuperAdmin ? null : $user->prodi;

        $data = $this->buildDashboardData($prodiFilter);

        return response(view('Admin.dashboard', array_merge($data, ['isSuperAdmin' => $isSuperAdmin])))
            ->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
                'Pragma'        => 'no-cache',
                'Expires'       => '0',
            ]);
    }

    private function buildDashboardData(?string $prodiFilter): array
    {
        // ── Card statistik ──────────────────────────────────────────

        $totalAlumni = DataAlumni::when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->count();

        $terserapKerja = DataAlumni::whereHas('pekerjaan')
            ->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->count();

        $persentaseTerserap = $totalAlumni > 0
            ? round(($terserapKerja / $totalAlumni) * 100, 1)
            : 0;

        // ── Grafik pertumbuhan alumni per angkatan ─────────────────

        $grafikRaw = DataAlumni::whereNotNull('angkatan')
            ->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->select('angkatan as tahun', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'asc')
            ->get()
            ->keyBy('tahun');

        // Simpan sebagai array biasa agar bisa di-cache (tidak pakai Collection/object)
        $grafik = [];
        if ($grafikRaw->isNotEmpty()) {
            $tahunMin = (int) $grafikRaw->keys()->min();
            $tahunMax = (int) $grafikRaw->keys()->max();
            for ($tahun = $tahunMin; $tahun <= $tahunMax; $tahun++) {
                $grafik[] = [
                    'tahun'  => $tahun,
                    'jumlah' => $grafikRaw->has($tahun) ? $grafikRaw[$tahun]->jumlah : 0,
                ];
            }
        }

        // ── Grafik masa tunggu kerja ───────────────────────────────

        $alumniDenganTunggu = DataAlumni::whereNotNull('lama_tunggu_kerja')
            ->where('lama_tunggu_kerja', '!=', '')
            ->when($prodiFilter, fn($q) => $q->where('prodi', $prodiFilter))
            ->pluck('lama_tunggu_kerja');

        $kurangSatuTahun = 0;
        $satuDuaTahun    = 0;
        $lebihDuaTahun   = 0;

        foreach ($alumniDenganTunggu as $lamaTunggu) {
            $bulan = $this->parseLamaTungguKeBulan($lamaTunggu);
            if ($bulan === null) continue;
            if ($bulan < 12)       $kurangSatuTahun++;
            elseif ($bulan <= 24)  $satuDuaTahun++;
            else                   $lebihDuaTahun++;
        }

        // Array biasa — aman untuk cache
        $masaTunggu = [
            ['label' => '< 1 Tahun',   'jumlah' => $kurangSatuTahun],
            ['label' => '1 - 2 Tahun', 'jumlah' => $satuDuaTahun],
            ['label' => '> 2 Tahun',   'jumlah' => $lebihDuaTahun],
        ];

        // ── Grafik rata-rata masa kerja per 1 tempat kerja per angkatan ──

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
            $nim     = $p->nim;
            $mulai   = Carbon::parse($p->tahun_masuk)->startOfMonth();
            $selesai = $p->tahun_selesai
                ? Carbon::parse($p->tahun_selesai)->startOfMonth()
                : now()->startOfMonth();
            $durasi  = max(0, $mulai->diffInMonths($selesai));

            if (!isset($durasiPerAlumni[$nim])) {
                $durasiPerAlumni[$nim] = ['angkatan' => (int) $p->angkatan, 'durasi' => []];
            }
            $durasiPerAlumni[$nim]['durasi'][] = $durasi;
        }

        $rataPerAngkatan = [];
        foreach ($durasiPerAlumni as $alumniData) {
            $angkatan   = $alumniData['angkatan'];
            $rataAlumni = array_sum($alumniData['durasi']) / count($alumniData['durasi']);
            $rataPerAngkatan[$angkatan][] = $rataAlumni;
        }

        ksort($rataPerAngkatan);
        $masaKerjaLabels = [];
        $masaKerjaData   = [];
        foreach ($rataPerAngkatan as $angkatan => $nilaiAlumni) {
            $masaKerjaLabels[] = (string) $angkatan;
            $masaKerjaData[]   = round(array_sum($nilaiAlumni) / count($nilaiAlumni) / 12, 1);
        }

        return compact(
            'totalAlumni',
            'terserapKerja',
            'persentaseTerserap',
            'grafik',
            'masaTunggu',
            'masaKerjaLabels',
            'masaKerjaData'
        );
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

        if ($found) return $total;

        if (preg_match('/^(\d+)$/', $str, $m)) return (int) $m[1];

        if (str_contains($str, 'kurang')) return 0;

        return null;
    }
}
