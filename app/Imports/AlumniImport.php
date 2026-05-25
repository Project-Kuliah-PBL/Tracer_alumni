<?php

namespace App\Imports;

use App\Models\Prodi;
use App\Helpers\LamaTungguHelper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Strategy: ToCollection (baca semua baris dulu) lalu proses dalam satu DB transaction.
 *
 * Optimasi utama:
 * 1. Pre-load semua NIM existing → eliminasi N+1 query
 * 2. Hash::make() hanya untuk NIM yang benar-benar baru, dikumpulkan dulu
 *    lalu di-hash SEBELUM transaksi DB dibuka → tidak blocking transaksi
 * 3. Semua INSERT/UPDATE dalam satu DB::transaction() → satu commit
 * 4. Batch INSERT untuk data_alumni, users, data_pekerjaan
 * 5. LamaTungguHelper dihitung SETELAH semua insert selesai
 */
class AlumniImport implements ToCollection, WithHeadingRow
{
    public int   $imported = 0;
    public int   $updated  = 0;
    public int   $skipped  = 0;
    public array $errors   = [];

    private array $nimToRecalculate = [];
    private array $prodiMap         = [];

    public function __construct()
    {
        Prodi::whereNotNull('kode_nim')->where('kode_nim', '!=', '')
            ->get(['nama', 'kode_nim'])
            ->each(fn($p) => $this->prodiMap[strtoupper(trim($p->kode_nim))] = $p->nama);
    }

    public function collection(Collection $rows): void
    {
        // ── PRE-LOAD: satu query per tabel ───────────────────────────
        $existingAlumni   = DB::table('data_alumni')->pluck('nim')->flip()->all();
        $existingUsers    = DB::table('users')->pluck('username')->flip()->all();
        $existingPekerjaan = DB::table('data_pekerjaan')
            ->select(DB::raw("CONCAT(nim,'|',nama_perusahaan) as k"))
            ->pluck('k')->flip()->all();

        // ── PARSE semua baris terlebih dahulu ────────────────────────
        $parsed = [];
        foreach ($rows as $index => $row) {
            try {
                $p = $this->parseRow($row->toArray(), $index + 2);
                if ($p) $parsed[] = $p;
                else     $this->skipped++;
            } catch (\Throwable $e) {
                $this->errors[] = "Baris " . ($index + 2) . ": " . $e->getMessage();
            }
        }

        if (empty($parsed)) return;

        // ── PRE-COMPUTE HASH untuk user baru ─────────────────────────
        // Hash::make dengan bcrypt rounds=12 ~0.3-0.5 detik per call.
        // Kita kumpulkan semua NIM baru, hash sekaligus SEBELUM buka transaksi DB,
        // sehingga transaksi DB tidak terbuka lama menunggu bcrypt.
        $newUserHashes = [];
        foreach ($parsed as $p) {
            $nim = $p['nim'];
            if (!isset($existingUsers[$nim]) && !isset($newUserHashes[$nim])) {
                $newUserHashes[$nim] = Hash::make($nim);
            }
        }

        // ── BATCH INSERT/UPDATE dalam satu transaksi ─────────────────
        $now = now()->toDateTimeString();

        $batchAlumniInsert   = [];
        $batchUserInsert     = [];
        $batchPekerjaanInsert = [];

        DB::transaction(function () use (
            $parsed, $existingAlumni, $existingUsers, $existingPekerjaan,
            $newUserHashes, $now,
            &$batchAlumniInsert, &$batchUserInsert, &$batchPekerjaanInsert
        ) {
            foreach ($parsed as $p) {
                $nim = $p['nim'];

                // ── Alumni ───────────────────────────────────────────
                if (!isset($existingAlumni[$nim])) {
                    $batchAlumniInsert[] = [
                        'nim'               => $nim,
                        'nama'              => $p['nama'],
                        'angkatan'          => $p['angkatan'],
                        'alamat'            => $p['alamat'],
                        'no_telepon'        => $p['no_hp'],
                        'email'             => $p['email'],
                        'jenis_kelamin'     => $p['jenis_kelamin'],
                        'prodi'             => $p['prodi'],
                        'tahun_lulus'       => $p['tahun_lulus'],
                        'lama_tunggu_kerja' => $p['lama_tunggu'],
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    $existingAlumni[$nim] = true;
                    $this->imported++;
                } else {
                    // UPDATE hanya field yang ada nilainya
                    $upd = ['nama' => $p['nama'], 'updated_at' => $now];
                    if ($p['angkatan'])      $upd['angkatan']          = $p['angkatan'];
                    if ($p['alamat'])        $upd['alamat']            = $p['alamat'];
                    if ($p['no_hp'])         $upd['no_telepon']        = $p['no_hp'];
                    if ($p['email'])         $upd['email']             = $p['email'];
                    if ($p['jenis_kelamin']) $upd['jenis_kelamin']     = $p['jenis_kelamin'];
                    if ($p['prodi'])         $upd['prodi']             = $p['prodi'];
                    if ($p['tahun_lulus'])   $upd['tahun_lulus']       = $p['tahun_lulus'];
                    if ($p['lama_tunggu'])   $upd['lama_tunggu_kerja'] = $p['lama_tunggu'];

                    DB::table('data_alumni')->where('nim', $nim)->update($upd);
                    $this->updated++;
                }

                // ── User ─────────────────────────────────────────────
                if (!isset($existingUsers[$nim]) && isset($newUserHashes[$nim])) {
                    $batchUserInsert[] = [
                        'username'   => $nim,
                        'password'   => $newUserHashes[$nim],
                        'role'       => 'Alumni',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                    $existingUsers[$nim] = true;
                }

                // ── Pekerjaan ─────────────────────────────────────────
                if (!empty($p['nama_perusahaan'])) {
                    $key = $nim . '|' . $p['nama_perusahaan'];
                    if (!isset($existingPekerjaan[$key])) {
                        $batchPekerjaanInsert[] = [
                            'nim'              => $nim,
                            'nama_perusahaan'  => $p['nama_perusahaan'],
                            'status_pekerjaan' => $p['status_pekerjaan'] ?? 'Tidak Diketahui',
                            'jobdesk'          => $p['divisi'],
                            'divisi'           => $p['divisi'],
                            'deskripsi'        => $p['jobdesc'],
                            'tahun_masuk'      => $p['tahun_masuk'],
                            'tahun_selesai'    => $p['tahun_selesai'],
                            'created_at'       => $now,
                            'updated_at'       => $now,
                        ];

                        $existingPekerjaan[$key] = true;
                        $this->nimToRecalculate[] = $nim;
                    }
                }
            }

            // Batch insert — satu query untuk semua baris baru
            if (!empty($batchAlumniInsert)) {
                foreach (array_chunk($batchAlumniInsert, 100) as $chunk) {
                    DB::table('data_alumni')->insert($chunk);
                }
            }
            if (!empty($batchUserInsert)) {
                foreach (array_chunk($batchUserInsert, 100) as $chunk) {
                    DB::table('users')->insert($chunk);
                }
            }
            if (!empty($batchPekerjaanInsert)) {
                foreach (array_chunk($batchPekerjaanInsert, 100) as $chunk) {
                    DB::table('data_pekerjaan')->insert($chunk);
                }
            }
        });
    }

    /**
     * Panggil setelah Excel::import() selesai.
     */
    public function recalculateLamaTunggu(): void
    {
        foreach (array_unique($this->nimToRecalculate) as $nim) {
            LamaTungguHelper::hitung($nim);
        }
        $this->nimToRecalculate = [];
    }

    // ── PARSE SATU BARIS ─────────────────────────────────────────────────────

    private function parseRow(array $row, int $lineNumber): ?array
    {
        $n = [];
        foreach ($row as $key => $value) {
            $clean = strtolower(trim(preg_replace('/[^a-z0-9]/i', '_', (string) $key)));
            $clean = trim(preg_replace('/_+/', '_', $clean), '_');
            $n[$clean] = ($value !== null && $value !== '') ? trim((string) $value) : null;
        }

        // NIM & Nama
        $nim  = null;
        $nama = null;

        foreach ($n as $k => $v) {
            if (empty($v)) continue;
            if (in_array($k, ['nim','no_nim','nrp','nomor_induk','student_id','id_mahasiswa','no_induk','nomor_induk_mahasiswa'])) {
                if (preg_match('/^[A-Z]\d{5,}$/i', trim($v))) {
                    $nim = strtoupper(trim($v));
                    break;
                }
            }
        }

        foreach ($n as $v) {
            if (empty($v)) continue;
            if (preg_match('/^(.+?)\s+[\-\x{2013}\x{2014}]\s+([A-Z]\d{5,})\s*$/iu', $v, $m)) {
                if (empty($nim))  $nim  = strtoupper(trim($m[2]));
                if (empty($nama)) $nama = trim($m[1]);
                break;
            }
        }

        if (empty($nama)) {
            foreach ($n as $k => $v) {
                if (empty($v)) continue;
                if (in_array($k, ['nama','nama_lengkap','full_name','name','nama_mahasiswa','nama_alumni'])) {
                    if (!preg_match('/[A-Z]\d{5,}/i', $v)) { $nama = $v; break; }
                }
            }
        }

        if (empty($nim)) {
            foreach ($n as $v) {
                if (!empty($v) && preg_match('/^[A-Z]\d{7,}$/i', trim($v))) {
                    $nim = strtoupper(trim($v)); break;
                }
            }
        }

        if (empty($nim) || empty($nama)) return null;

        // Angkatan
        $angkatan = null;
        if (preg_match('/^[A-Z]\d{2}(\d{2})\d+$/i', $nim, $m)) $angkatan = '20' . $m[1];
        $angkatanKolom = $this->get($n, ['angkatan','tahun_angkatan','tahun_masuk_kuliah']);
        if (!empty($angkatanKolom) && preg_match('/\b(20\d{2})\b/', $angkatanKolom, $m)) $angkatan = $m[1];

        // Profil
        $jenisKelaminRaw = $this->get($n, ['jenis_kelamin','gender','kelamin','sex']);
        $jk = null;
        if ($jenisKelaminRaw) {
            $jkl = strtolower(trim($jenisKelaminRaw));
            if (str_contains($jkl,'laki') || in_array($jkl,['l','m','male']))                                    $jk = 'Laki-laki';
            elseif (str_contains($jkl,'perempuan') || str_contains($jkl,'wanita') || in_array($jkl,['p','f','female'])) $jk = 'Perempuan';
        }

        $prodiRaw = $this->get($n, ['prodi','program_studi','jurusan','departemen','major']);
        $prodi    = $prodiRaw ?: $this->detectProdi($nim);

        $tahunLulusRaw = $this->get($n, ['tahun_lulus','tahun_yudisium','yudisium','tanggal_yudisium','graduation_year','tahun_wisuda']);

        // Pekerjaan
        $namaPerusahaan  = $this->get($n, ['nama_perusahaan','perusahaan','company','instansi','tempat_kerja']);
        $statusKerja     = $this->get($n, ['status','status_kerja','status_pekerjaan_alumni','employment_status']);
        $statusPekerjaan = $this->get($n, ['status_pekerjaan','jenis_pekerjaan','tipe_pekerjaan','employment_type']);
        $divisi          = $this->get($n, ['divisi_pekerjaan','divisi','departemen_kerja','department','bidang_kerja']);
        $jobdesc         = $this->get($n, ['job_description','jobdesc','deskripsi_pekerjaan','description','uraian_tugas','job_description_1']);
        $tahunBerakhir   = $this->get($n, ['tahun_berakhir_kerja','tahun_selesai','tanggal_selesai','end_date','tahun_berakhir']);
        $tanggalMasukRaw = $this->get($n, ['tanggal_masuk','tanggal_mulai_kerja','mulai_kerja','tahun_masuk_kerja','start_date','tanggal_bergabung']);

        // Jika tidak ada nama perusahaan tapi status "sudah bekerja", tetap tidak ada data pekerjaan
        $perusahaanFinal = (!empty($namaPerusahaan)
            || (!empty($statusKerja) && strtolower(trim($statusKerja)) === 'sudah bekerja'))
            ? $namaPerusahaan : null;

        return [
            'nim'             => $nim,
            'nama'            => $nama,
            'angkatan'        => $angkatan,
            'alamat'          => $this->get($n, ['alamat','alamat_tempat_tinggal_tetap','alamat_tinggal','address','domisili']),
            'no_hp'           => $this->get($n, ['no__hp','no_hp','hp','telepon','no_telepon','phone','nomor_hp','handphone']),
            'email'           => $this->get($n, ['email','email_address','surel']),
            'jenis_kelamin'   => $jk,
            'prodi'           => $prodi,
            'lama_tunggu'     => $this->get($n, ['lama_tunggu_kerja','lama_tunggu','masa_tunggu','waiting_time']),
            'tahun_lulus'     => !empty($tahunLulusRaw) ? $this->parseTanggal($tahunLulusRaw) : null,
            'nama_perusahaan' => $perusahaanFinal,
            'status_pekerjaan'=> $statusPekerjaan,
            'divisi'          => $divisi,
            'jobdesc'         => $jobdesc,
            'tahun_masuk'     => !empty($tanggalMasukRaw) ? $this->parseTanggal($tanggalMasukRaw) : null,
            'tahun_selesai'   => !empty($tahunBerakhir)   ? $this->parseTanggal($tahunBerakhir)   : null,
        ];
    }

    // ── HELPERS ──────────────────────────────────────────────────────────────

    private function get(array $data, array $keys): ?string
    {
        foreach ($keys as $key) {
            if (isset($data[$key]) && $data[$key] !== null && $data[$key] !== '') return $data[$key];
        }
        foreach ($keys as $keyword) {
            if ($keyword === 'nama') continue;
            foreach ($data as $k => $v) {
                if (str_contains($k, $keyword) && $v !== null && $v !== '') return $v;
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
            if (str_starts_with(strtoupper($nim), strtoupper($kode))) return $this->prodiMap[$kode];
        }
        return null;
    }

    private function parseTanggal(string $str): ?string
    {
        if (preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})#', $str, $m))  return sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        if (preg_match('/^(\d{4}-\d{2}-\d{2})/', $str, $m))           return $m[1];
        if (preg_match('#^(\d{1,2})-(\d{1,2})-(\d{4})#', $str, $m))  return sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        if (preg_match('#^(\d{4})/(\d{1,2})/(\d{1,2})#', $str, $m))  return sprintf('%04d-%02d-%02d', $m[1], $m[2], $m[3]);
        if (preg_match('/\b(20\d{2})\b/', $str, $m))                  return $m[1] . '-01-01';
        if (is_numeric($str) && (int)$str > 40000) {
            try {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float)$str)->format('Y-m-d');
            } catch (\Throwable) {}
        }
        return null;
    }
}
