<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    //
    protected $fillable = ['kode_jurnal', 'lokasi', 'staf_id', 'tanggal', 'kegiatan', 'mulai', 'selesai', 'status', 'ket'];

    public function stafs()
    {
        return $this->belongsTo('App\User', 'staf_id', 'nip');
    }
}
