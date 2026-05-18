<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPekerjaan extends Model
{
    protected $table = 'data_pekerjaan';

    protected $fillable = [
        'nim',
        'nama_perusahaan',
        'status_pekerjaan',
        'jobdesk',
        'divisi',
        'lokasi',
        'tahun_masuk',
        'tahun_selesai',
        'deskripsi',
        'logo_perusahaan',
    ];

    protected $casts = [
        'tahun_masuk'   => 'date',
        'tahun_selesai' => 'date',
    ];

    public function alumni()
    {
        return $this->belongsTo(DataAlumni::class, 'nim', 'nim');
    }
}