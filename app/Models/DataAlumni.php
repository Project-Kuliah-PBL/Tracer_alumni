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
        'nama',
        'alamat',
        'jenis_kelamin',
        'email',
        'no_telepon',
        'lama_tunggu_kerja',
        'tahun_lulus',
        'jabatan_sekarang',
        'foto_profile',
        'foto_sampul',
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
