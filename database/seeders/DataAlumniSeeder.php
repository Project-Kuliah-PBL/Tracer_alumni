<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataAlumniSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $nim = 'A' . str_pad($i, 4, '0', STR_PAD_LEFT);

            // INSERT ALUMNI
            DB::table('data_alumni')->insert([
                'nim' => $nim,
                'nama' => 'Alumni ' . $i,
                'alamat' => 'Surabaya',
                'jenis_kelamin' => $i % 2 == 0 ? 'Perempuan' : 'Laki-laki',
                'email' => "alumni$i@gmail.com",
                'no_telepon' => '08123' . rand(100000,999999),
                'lama_tunggu_kerja' => rand(1,6) . ' bulan',
                'tahun_lulus' => now()->subYears(rand(1,5)),
                'jabatan_sekarang' => 'Software Engineer',
                'foto_profile' => 'default.jpg',
                'foto_sampul' => 'cover.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // PEKERJAAN
            DB::table('data_pekerjaan')->insert([
                'nim' => $nim,
                'nama_perusahaan' => 'PT Teknologi ' . $i,
                'status_pekerjaan' => 'Full Time',
                'jobdesk' => 'Backend Developer',
                'tahun_masuk' => now()->subYears(rand(1,3)),
                'tahun_selesai' => null,
                'deskripsi' => 'Bekerja sebagai developer',
                'logo_perusahaan' => 'logo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // PENDIDIKAN
            DB::table('riwayat_pendidikan')->insert([
                'nim' => $nim,
                'nama_instansi' => 'Universitas Contoh',
                'jenjang_pendidikan' => 'S1',
                'jurusan' => 'Informatika',
                'tahun_masuk' => now()->subYears(6),
                'tahun_keluar' => now()->subYears(2),
                'nilai_akhir' => rand(30,40) / 10,
                'judul_skripsi' => 'Sistem Informasi Alumni',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // MEDIA SOSIAL
            DB::table('media_sosial')->insert([
                'nim' => $nim,
                'nama_platform' => 'LinkedIn',
                'link_medsos' => 'https://linkedin.com/in/alumni' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // CERTIFICATE
            DB::table('data_certificate')->insert([
                'nim' => $nim,
                'nama' => 'Sertifikat Laravel ' . $i,
                'tanggal_terbit' => now()->subYears(rand(1,3)),
                'diterbitkan_oleh' => 'Dicoding',
                'gambar_serti' => 'sertifikat.jpg',
                'id_kredensial' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}