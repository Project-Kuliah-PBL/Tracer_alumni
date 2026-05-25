<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DataAlumniSeeder extends Seeder
{
    public function run(): void
    {
        $prodi = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Manajemen Informatika',
            'Teknik Komputer',
        ];

        $statusPekerjaan = [
            'Pekerjaan Tetap',
            'Kontrak',
            'Freelance',
            'Magang',
            'Part Time',
        ];

        $perusahaan = [
            'PT Teknologi Nusantara',
            'CV Digital Solusi',
            'PT Inovasi Indonesia',
            'Startup Kreatif',
            'PT Data Global',
            'CV Maju Bersama',
            'PT Sistem Canggih',
            'PT Solusi Prima',
        ];

        $kota = [
            'Surabaya', 'Jakarta', 'Bandung', 'Malang',
            'Yogyakarta', 'Semarang', 'Sidoarjo', 'Gresik',
        ];

        $jobdesk = [
            'Backend Developer',
            'Frontend Developer',
            'Full Stack Developer',
            'Data Analyst',
            'UI/UX Designer',
            'DevOps Engineer',
            'Mobile Developer',
            'Software Engineer',
        ];

        $divisi = [
            'Engineering',
            'Product',
            'Design',
            'Data & Analytics',
            'Infrastructure',
            'Marketing Tech',
        ];

        $platform = ['LinkedIn', 'GitHub', 'Instagram', 'Portfolio'];

        for ($i = 1; $i <= 20; $i++) {
            // Format NIM: E41240001, E41240002, dst
            $nim = 'E41240' . str_pad($i, 3, '0', STR_PAD_LEFT);

            $tahunLulus     = now()->subYears(rand(1, 4))->subMonths(rand(0, 11));
            $tahunMasukKerja = (clone $tahunLulus)->addMonths(rand(1, 18));
            $masihBekerja   = $i % 3 !== 0; // 2/3 masih aktif bekerja
            $tahunSelesai   = $masihBekerja ? null : (clone $tahunMasukKerja)->addMonths(rand(6, 24));

            // Hitung lama tunggu otomatis
            $bulanTunggu = (int) $tahunLulus->diffInMonths($tahunMasukKerja);
            if ($bulanTunggu < 1) {
                $lamaTunggu = 'Kurang dari 1 Bulan';
            } elseif ($bulanTunggu < 12) {
                $lamaTunggu = $bulanTunggu . ' Bulan';
            } else {
                $t = intdiv($bulanTunggu, 12);
                $b = $bulanTunggu % 12;
                $lamaTunggu = $b > 0 ? "{$t} Tahun {$b} Bulan" : "{$t} Tahun";
            }

            $pekerjaanIdx    = array_rand($perusahaan);
            $namaPerusahaan  = $perusahaan[$pekerjaanIdx];
            $posisi          = $jobdesk[array_rand($jobdesk)];
            $jabatan         = $posisi . ' – ' . $namaPerusahaan;

            // ── data_alumni ──────────────────────────────────────────────
            DB::table('data_alumni')->insert([
                'nim'              => $nim,
                'prodi'            => $prodi[array_rand($prodi)],
                'nama'             => 'Alumni ' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'alamat'           => $kota[array_rand($kota)] . ', Jawa Timur',
                'jenis_kelamin'    => $i % 2 === 0 ? 'Perempuan' : 'Laki-laki',
                'email'            => "alumni{$nim}@gmail.com",
                'show_email'       => (bool) rand(0, 1),
                'no_telepon'       => '0812' . rand(10000000, 99999999),
                'show_telepon'     => (bool) rand(0, 1),
                'lama_tunggu_kerja'=> $lamaTunggu,
                'tahun_lulus'      => $tahunLulus->toDateString(),
                'jabatan_sekarang' => $jabatan,
                'foto_profile'     => null,
                'foto_sampul'      => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // ── data_pekerjaan ───────────────────────────────────────────
            DB::table('data_pekerjaan')->insert([
                'nim'              => $nim,
                'nama_perusahaan'  => $namaPerusahaan,
                'status_pekerjaan' => $statusPekerjaan[array_rand($statusPekerjaan)],
                'jobdesk'          => $posisi,
                'divisi'           => $divisi[array_rand($divisi)],
                'lokasi'           => $kota[array_rand($kota)],
                'tahun_masuk'      => $tahunMasukKerja->toDateString(),
                'tahun_selesai'    => $tahunSelesai?->toDateString(),
                'deskripsi'        => "Bertanggung jawab atas pengembangan sistem di divisi {$divisi[array_rand($divisi)]}.",
                'logo_perusahaan'  => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // ── riwayat_pendidikan ───────────────────────────────────────
            DB::table('riwayat_pendidikan')->insert([
                'nim'                => $nim,
                'nama_instansi'      => 'Politeknik Negeri Jember PSDKU Sidoarjo',
                'jenjang_pendidikan' => 'D4',
                'jurusan'            => $prodi[array_rand($prodi)],
                'tahun_masuk'        => (clone $tahunLulus)->subYears(4)->toDateString(),
                'tahun_keluar'       => $tahunLulus->toDateString(),
                'nilai_akhir'        => round(rand(300, 400) / 100, 2),
                'judul_skripsi'      => 'Pengembangan Sistem Informasi Alumni Berbasis Web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);

            // ── media_sosial ─────────────────────────────────────────────
            $platforms = array_rand(array_flip($platform), rand(1, 3));
            if (is_string($platforms)) $platforms = [$platforms];
            foreach ($platforms as $p) {
                $link = match ($p) {
                    'LinkedIn'  => "https://linkedin.com/in/alumni-{$nim}",
                    'GitHub'    => "https://github.com/alumni-{$nim}",
                    'Instagram' => "https://instagram.com/alumni_{$nim}",
                    'Portfolio' => "https://portfolio-alumni{$i}.vercel.app",
                };
                DB::table('media_sosial')->insert([
                    'nim'           => $nim,
                    'nama_platform' => $p,
                    'link_medsos'   => $link,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }

            // ── data_certificate ─────────────────────────────────────────
            $sertifikat = [
                ['nama' => 'Laravel Fundamentals',   'oleh' => 'Dicoding'],
                ['nama' => 'Web Development Bootcamp','oleh' => 'Udemy'],
                ['nama' => 'Google IT Support',       'oleh' => 'Coursera'],
                ['nama' => 'AWS Cloud Practitioner',  'oleh' => 'Amazon'],
                ['nama' => 'React.js Dasar',          'oleh' => 'Dicoding'],
            ];
            $cert = $sertifikat[array_rand($sertifikat)];
            DB::table('data_certificate')->insert([
                'nim'              => $nim,
                'nama'             => $cert['nama'],
                'tanggal_terbit'   => now()->subMonths(rand(3, 24))->toDateString(),
                'diterbitkan_oleh' => $cert['oleh'],
                'gambar_serti'     => null,
                'id_kredensial'    => Str::upper(Str::random(8)) . $i,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // ── users (akun login alumni) — password = NIM ───────────────
            DB::table('users')->insertOrIgnore([
                'username'   => $nim,
                'password'   => Hash::make($nim),
                'role'       => 'Alumni',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}