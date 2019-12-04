<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    //
    protected $fillable = [
        'npsn', 'nss', 'nama_sekolah', 'kepsek', 'nip_kepsek', 'alamat_sekolah', 'telepon', 'email', 'website'
    ];
}
