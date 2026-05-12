<?php

namespace App\Helpers;

use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use Carbon\Carbon;

class LamaTungguHelper
{
    /**
     * Hitung dan simpan lama tunggu kerja untuk satu alumni.
     * Diambil dari selisih tahun_lulus dan pekerjaan pertama (tahun_masuk terlama).
     * Selalu dihitung ulang (tidak skip jika sudah ada).
     */
    public static function hitung(string $nim): void
    {
        $alumni = DataAlumni::where('nim', $nim)->first();
        if (!$alumni) return;

        // Ambil pekerjaan dengan tahun_masuk paling awal
        $pekerjaanPertama = DataPekerjaan::where('nim', $nim)
            ->whereNotNull('tahun_masuk')
            ->orderBy('tahun_masuk', 'asc')
            ->first();

        if (!$pekerjaanPertama) return;

        $masuk = Carbon::parse($pekerjaanPertama->tahun_masuk)->startOfDay();

        // Gunakan tahun_lulus jika ada, fallback ke tahun_masuk pekerjaan - tidak bisa hitung
        if (!$alumni->tahun_lulus) {
            // Tidak bisa hitung tanpa tanggal lulus
            return;
        }

        $lulus = Carbon::parse($alumni->tahun_lulus)->startOfDay();

        // Jika masuk kerja sebelum lulus, set 0 (langsung kerja)
        if ($masuk->lt($lulus)) {
            $alumni->lama_tunggu_kerja = 'Kurang dari 1 Bulan';
            $alumni->save();
            return;
        }

        $bulan = (int) $lulus->diffInMonths($masuk);

        if ($bulan < 1) {
            $hasil = 'Kurang dari 1 Bulan';
        } elseif ($bulan < 12) {
            $hasil = $bulan . ' Bulan';
        } else {
            $tahunTunggu = intdiv($bulan, 12);
            $sisaBulan   = $bulan % 12;
            $hasil = $sisaBulan > 0
                ? "{$tahunTunggu} Tahun {$sisaBulan} Bulan"
                : "{$tahunTunggu} Tahun";
        }

        $alumni->lama_tunggu_kerja = $hasil;
        $alumni->save();
    }
}
