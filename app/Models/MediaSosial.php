<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaSosial extends Model
{
    protected $table = 'media_sosial';

    protected $fillable = [
        'nim',
        'nama_platform',
        'link_medsos',
    ];

    public function alumni()
    {
        return $this->belongsTo(DataAlumni::class, 'nim', 'nim');
    }
}
