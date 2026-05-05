<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    protected $table = 'riwayat_pendidikan';

    protected $fillable = [
        'nim',
        'nama_instansi',
        'jenjang_pendidikan',
        'jurusan',
        'tahun_masuk',
        'tahun_keluar',
        'nilai_akhir',
        'judul_skripsi',
    ];

    protected $casts = [
        'tahun_masuk'  => 'date',
        'tahun_keluar' => 'date',
        'nilai_akhir'  => 'float',
    ];

    public function alumni()
    {
        return $this->belongsTo(DataAlumni::class, 'nim', 'nim');
    }
}
