<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAbsen extends Model
{
    //
    protected $fillable = ['kode_absen', 'hari', 'tanggal', 'guru_id', 'mapel_id', 'rombel_id', 'jamke', 'jml_siswa', 'hadir', 'ijin', 'sakit', 'alpa', 'telat', 'jurnal','ket', 'isActive'];


    public function gurus()
    {
        return $this->belongsTo('App\User', 'guru_id', 'nip');
    }

    public function mapels()
    {
        return $this->belongsTo('App\Mapel', 'mapel_id', 'kode_mapel');
    }

    public function rombels()
    {
        return $this->belongsTo('App\Rombel', 'rombel_id', 'kode_rombel');
    }

    public function absens()
    {
        return $this->hasMany(\App\Absen, 'absen_id', 'kode_absen');
    }
}
