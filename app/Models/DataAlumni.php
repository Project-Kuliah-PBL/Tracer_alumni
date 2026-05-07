<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAlumni extends Model
{
    protected $table = 'data_alumni';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'prodi',
        'nama',
        'alamat',
        'jenis_kelamin',
        'email',
        'show_email',     // visibilitas email di halaman publik
        'no_telepon',
        'show_telepon',   // visibilitas no HP di halaman publik
        'lama_tunggu_kerja',
        'tahun_lulus',
        'jabatan_sekarang',
        'foto_profile',
        'foto_sampul',
    ];

    protected $casts = [
        'show_email'   => 'boolean',
        'show_telepon' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'username');
    }

    public function pekerjaan()
    {
        return $this->hasMany(DataPekerjaan::class, 'nim', 'nim');
    }

    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'nim', 'nim');
    }

    public function sertifikasi()
    {
        return $this->hasMany(DataCertificate::class, 'nim', 'nim');
    }

    public function mediaSosial()
    {
        return $this->hasMany(MediaSosial::class, 'nim', 'nim');
    }
}