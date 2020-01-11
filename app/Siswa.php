<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $fillable = ['nis', 'nisn', 'nama_siswa', 'jk', 'rombel_id', 'foto','ortu_id', 'jalan', 'desa', 'kec', 'kab', 'prov', 'hp', 'email'];

    public function rombels()
    {
    	return $this->belongsTo('App\Rombel', 'rombel_id', 'kode_rombel');
    }

    public function absens()
    {
    	return  $this->hasMany('App\Absen', 'siswa_id', 'nisn');
    }

    public function ortus()
    {
        return $this->belongsTo('App\Ortu', 'ortu_id', 'nik');
    }

    public function finger()
    {
        return $this->hasMany('App\Finger', 'nis', 'nisn');
    }
}
