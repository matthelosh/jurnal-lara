<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    //$table->string('absen_id');
            // $table->string('tanggal');
            // $table->string('siswa_id');
            // $table->string('ket');
    protected $fillable = ['absen_id', 'tanggal', 'siswa_id', 'ket'];

    public function logabsens()
    {
    	return $this->belongsTo(\App\LogAbsen, 'absen_id', 'kode_absen');
    }

    public function siswas()
    {
    	return $this->belongsTo('App\Siswa', 'siswa_id', 'nisn');
    }
}
