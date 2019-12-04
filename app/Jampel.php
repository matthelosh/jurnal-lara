<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jampel extends Model
{
    //
    protected $fillable = ['label', 'mulai', 'selesai'];

    public function jadwals()
    {
    	// $this->belongsToMany('App\Jadwal')
    }
}
