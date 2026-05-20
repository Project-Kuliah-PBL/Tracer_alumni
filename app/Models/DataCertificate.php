<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataCertificate extends Model
{
    protected $table = 'data_certificate';

    protected $fillable = [
        'nim',
        'nama',
        'tanggal_terbit',
        'tanggal_berakhir',
        'diterbitkan_oleh',
        'gambar_serti',
        'id_kredensial',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'tanggal_berakhir' => 'date',
    ];

    public function alumni()
    {
        return $this->belongsTo(DataAlumni::class, 'nim', 'nim');
    }
}
