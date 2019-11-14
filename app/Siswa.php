<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $fillable = ['nis', 'nisn', 'nama_siswa', 'jk', 'rombel_id'];

    public function rombels()
    {
    	return $this->belongsTo('App\Rombel', 'rombel_id', 'kode_rombel');
    }
}
