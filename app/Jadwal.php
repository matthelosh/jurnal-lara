<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    //
    protected $fillable = ['kode_jadwal','hari', 'guru_id', 'mapel_id', 'rombel_id', 'jamke', 'status'];

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
}
