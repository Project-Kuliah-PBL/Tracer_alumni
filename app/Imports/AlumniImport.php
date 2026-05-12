<?php

namespace App\Imports;

use App\Models\DataAlumni;
use App\Models\DataPekerjaan;
use App\Models\User;
use App\Models\Prodi;
use App\Helpers\LamaTungguHelper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniImport implements ToCollection, WithHeadingRow
{
    public int   $imported = 0;
    public int   $updated  = 0;
    public int   $skipped  = 0;
    public array $errors   = [];

    private array $prodiMap = [];

    public function __construct()
    {
        Prodi::whereNotNull('kode_nim')->where('kode_nim', '!=', '')
            ->get(['nama', 'kode_nim'])
            ->each(fn($p) => $this->prodiMap[strtoupper(trim($p->kode_nim))] = $p->nama);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            try {
                $this->processRow($row->toArray(), $index + 2);
            } catch (\Throwable $e) {
                $this->errors[] = "Baris " . ($index + 2) . ": " . $e->getMessage();
            }
        }
    }

    private function processRow(array $row, int $lineNumber): void
    {
        // Normalisasi key
        $n = [];
        foreach ($row as $key => $value) {
            $clean = strtolower(trim(preg_replace('/[^a-z0-9]/i', '_', (string) $key)));
            $clean = trim(preg_replace('/_+/', '_', $clean), '_');
            $n[$clean] = ($value !== null && $value !== '') ? trim((string) $value) : null;
        }

        // ── STEP 1: Cari NIM dan Nama ────────────────────────────────
        $nim  = null;
        $nama = null;

        // Prioritas 1: kolom NIM terpisah
        foreach ($n as $k => $v) {
            if (empty($v)) continue;
            // Key yang kemungkinan adalah kolom NIM murni
            if (in_array($k, ['nim', 'no_nim', 'nrp', 'nomor_induk', 'student_id', 'id_mahasiswa', 'no_induk', 'nomor_induk_mahasiswa'])) {
                if (preg_match('/^[A-Z]\d{5,}$/i', trim($v))) {
                    $nim = strtoupper(trim($v));
                    break;
                }
            }
        }

        // Prioritas 2: scan SEMUA value — cari yang mengandung pola "Teks - NIM"
        // Regex: di akhir string ada " - " diikuti huruf+digit (NIM)
        foreach ($n as $k => $v) {
            if (empty($v)) continue;
            if (preg_match('/^(.+?)\s+-\s+([A-Z]\d{5,})\s*$/i', $v, $m)) {
                if (empty($nim))  $nim  = strtoupper(trim($m[2]));
                if (empty($nama)) $nama = trim($m[1]);
                break;
            }
        }

        // Prioritas 3: kolom nama terpisah (hanya jika value tidak mengandung NIM)
        if (empty($nama)) {
            foreach ($n as $k => $v) {
                if (empty($v)) continue;
                if (in_array($k, ['nama', 'nama_lengkap', 'full_name', 'name', 'nama_mahasiswa', 'nama_alumni'])) {
                    // Pastikan bukan string gabungan
                    if (!preg_match('/[A-Z]\d{5,}/i', $v)) {
                        $nama = $v;
                        break;
                    }
                }
            }
        }

        // Prioritas 4: fallback scan value yang persis NIM
        if (empty($nim)) {
            foreach ($n as $v) {
                if (!empty($v) && preg_match('/^[A-Z]\d{7,}$/i', trim($v))) {
                    $nim = strtoupper(trim($v));
                    break;
                }
            }
        }

        if (empty($nim) || empty($nama)) {
            $this->skipped++;
            return;
        }

        // ── STEP 2: Angkatan dari NIM ────────────────────────────────
        // Pola: E4121xxxxx → digit ke-4 dan ke-5 = angkatan (21 → 2021)
        $angkatan = null;
        if (preg_match('/^[A-Z]\d{2}(\d{2})\d+$/i', $nim, $m)) {
            $angkatan = '20' . $m[1];
        }
        $angkatanKolom = $this->get($n, ['angkatan', 'tahun_angkatan', 'tahun_masuk_kuliah']);
        if (!empty($angkatanKolom) && preg_match('/\b(20\d{2})\b/', $angkatanKolom, $m)) {
            $angkatan = $m[1];
        }

        // ── STEP 3: Data profil ──────────────────────────────────────
        $alamat      = $this->get($n, ['alamat', 'alamat_tempat_tinggal_tetap', 'alamat_tinggal', 'address', 'domisili']);
        $noHp        = $this->get($n, ['no__hp', 'no_hp', 'hp', 'telepon', 'no_telepon', 'phone', 'nomor_hp', 'handphone']);
        $email       = $this->get($n, ['email', 'email_address', 'surel']);
        $jenisKelamin= $this->get($n, ['jenis_kelamin', 'gender', 'kelamin', 'sex']);
        $prodi       = $this->get($n, ['prodi', 'program_studi', 'jurusan', 'departemen', 'major']);
        $jabatan     = $this->get($n, ['jabatan_sekarang', 'jabatan', 'posisi', 'position', 'pekerjaan_sekarang']);
        $lamaTunggu  = $this->get($n, ['lama_tunggu_kerja', 'lama_tunggu', 'masa_tunggu', 'waiting_time']);
        $statusKerja = $this->get($n, ['status', 'status_kerja', 'status_pekerjaan_alumni', 'employment_status']);

        $tahunLulusRaw = $this->get($n, ['tahun_lulus', 'tahun_yudisium', 'yudisium', 'tanggal_yudisium', 'graduation_year', 'tahun_wisuda']);
        $tahunLulus = !empty($tahunLulusRaw) ? $this->parseTahunLulus($tahunLulusRaw) : null;

        $namaPerusahaan  = $this->get($n, ['nama_perusahaan', 'perusahaan', 'company', 'instansi', 'tempat_kerja']);
        $statusPekerjaan = $this->get($n, ['status_pekerjaan', 'jenis_pekerjaan', 'tipe_pekerjaan', 'employment_type']);
        $divisi          = $this->get($n, ['divisi_pekerjaan', 'divisi', 'departemen_kerja', 'department', 'bidang_kerja']);
        $jobdesc         = $this->get($n, ['job_description', 'jobdesc', 'deskripsi_pekerjaan', 'description', 'uraian_tugas']);

        // ── STEP 4: Simpan data_alumni ───────────────────────────────
        $alumni = DataAlumni::firstOrNew(['nim' => $nim]);
        $isNew  = !$alumni->exists;

        $alumni->nama     = $nama;
        $alumni->angkatan = $angkatan;

        if (!empty($alamat))     $alumni->alamat            = $alamat;
        if (!empty($noHp))       $alumni->no_telepon        = $noHp;
        if (!empty($email))      $alumni->email             = $email;
        if (!empty($jabatan))    $alumni->jabatan_sekarang  = $jabatan;
        if (!empty($lamaTunggu)) $alumni->lama_tunggu_kerja = $lamaTunggu;
        if ($tahunLulus)         $alumni->tahun_lulus       = $tahunLulus;

        // Prodi: dari kolom Excel atau deteksi dari kode NIM
        if (!empty($prodi)) {
            $alumni->prodi = $prodi;
        } elseif (empty($alumni->prodi)) {
            $prodiDariNim = $this->detectProdi($nim);
            if ($prodiDariNim) $alumni->prodi = $prodiDariNim;
        }

        if (!empty($jenisKelamin)) {
            $jk = strtolower($jenisKelamin);
            if (str_contains($jk, 'laki') || in_array($jk, ['l', 'm', 'male'])) {
                $alumni->jenis_kelamin = 'Laki-laki';
            } elseif (str_contains($jk, 'perempuan') || str_contains($jk, 'wanita') || in_array($jk, ['p', 'f', 'female'])) {
                $alumni->jenis_kelamin = 'Perempuan';
            }
        }

        if (empty($alumni->jabatan_sekarang) && !empty($divisi)
            && !empty($statusKerja) && strtolower($statusKerja) === 'sudah bekerja') {
            $alumni->jabatan_sekarang = $divisi;
        }

        $alumni->save();

        // ── STEP 5: Akun login ───────────────────────────────────────
        if (!User::where('username', $nim)->exists()) {
            User::create(['username' => $nim, 'password' => Hash::make($nim), 'role' => 'Alumni']);
        }

        // ── STEP 6: Data pekerjaan + hitung lama tunggu kerja ──────────
        if (!empty($namaPerusahaan) && !empty($statusKerja)
            && strtolower(trim($statusKerja)) === 'sudah bekerja') {

            $sudahAda = DataPekerjaan::where('nim', $nim)->where('nama_perusahaan', trim($namaPerusahaan))->exists();

            // Ambil tanggal masuk kerja dari kolom Excel jika ada
            $tanggalMasukKerja = $this->get($n, [
                'tanggal_masuk', 'tanggal_mulai_kerja', 'mulai_kerja',
                'tahun_masuk_kerja', 'start_date', 'tanggal_bergabung',
            ]);
            $tanggalMasukParsed = null;
            if (!empty($tanggalMasukKerja)) {
                $tanggalMasukParsed = $this->parseTahunLulus($tanggalMasukKerja);
            }

            if (!$sudahAda) {
                DataPekerjaan::create([
                    'nim'              => $nim,
                    'nama_perusahaan'  => trim($namaPerusahaan),
                    'status_pekerjaan' => !empty($statusPekerjaan) ? trim($statusPekerjaan) : 'Tidak Diketahui',
                    'jobdesk'          => !empty($divisi)  ? trim($divisi)  : null,
                    'divisi'           => !empty($divisi)  ? trim($divisi)  : null,
                    'deskripsi'        => !empty($jobdesc) ? trim($jobdesc) : null,
                    'tahun_masuk'      => $tanggalMasukParsed,
                ]);
            }

            // Hitung lama tunggu kerja via helper (berlaku untuk semua kondisi)
            LamaTungguHelper::hitung($nim);
        }

        $isNew ? $this->imported++ : $this->updated++;
    }

    // ── HELPERS ──────────────────────────────────────────────────────

    /**
     * Cari value dari array dengan exact match key saja (tidak fuzzy).
     * Lebih aman untuk menghindari false positive.
     */
    private function get(array $data, array $keys): ?string
    {
        foreach ($keys as $key) {
            if (isset($data[$key]) && $data[$key] !== null && $data[$key] !== '') {
                return $data[$key];
            }
        }
        // Fuzzy: key yang mengandung keyword (tapi tidak untuk 'nama' agar tidak ambil 'nama_nim')
        foreach ($keys as $keyword) {
            if ($keyword === 'nama') continue; // skip fuzzy untuk 'nama'
            foreach ($data as $k => $v) {
                if (str_contains($k, $keyword) && $v !== null && $v !== '') {
                    return $v;
                }
            }
        }
        return null;
    }

    private function detectProdi(string $nim): ?string
    {
        if (empty($this->prodiMap)) return null;
        $kodes = array_keys($this->prodiMap);
        usort($kodes, fn($a, $b) => strlen($b) - strlen($a));
        foreach ($kodes as $kode) {
            if (str_starts_with(strtoupper($nim), strtoupper($kode))) {
                return $this->prodiMap[$kode];
            }
        }
        return null;
    }

    private function parseTahunLulus(string $str): ?string
    {
        // Format: d/m/Y H:i:s atau d/m/Y (dari Google Form)
        // Contoh: "10/9/2025 11:28:28" → "2025-09-10"
        if (preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})#', $str, $m)) {
            return sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        }

        // Format: Y-m-d (sudah benar)
        if (preg_match('/^(\d{4}-\d{2}-\d{2})/', $str, $m)) {
            return $m[1];
        }

        // Format: d-m-Y
        if (preg_match('#^(\d{1,2})-(\d{1,2})-(\d{4})#', $str, $m)) {
            return sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        }

        // Format: Y/m/d
        if (preg_match('#^(\d{4})/(\d{1,2})/(\d{1,2})#', $str, $m)) {
            return sprintf('%04d-%02d-%02d', $m[1], $m[2], $m[3]);
        }

        // Hanya tahun 4 digit
        if (preg_match('/\b(20\d{2})\b/', $str, $m)) {
            return $m[1] . '-01-01';
        }

        // Excel serial date (angka)
        if (is_numeric($str) && (int)$str > 40000) {
            try {
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $str);
                return $date->format('Y-m-d');
            } catch (\Throwable) {}
        }

        return null;
    }
}
