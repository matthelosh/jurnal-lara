<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    //
    protected $fillable = ['kode_rombel', 'nama_rombel', 'guru_id'];

    public function gurus()
    {
    	return $this->belongsTo('\App\User', 'guru_id', 'nip');
    }

    public function siswas()
    {
    	return $this->hasMany('App\Siswa', 'rombel_id', 'kode_rombel');
    }
}
