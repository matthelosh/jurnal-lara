<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    //
    protected $fillable = ['kode_mapel', 'nama_mapel'];

    public function logabsens()
    {
        return $this->hasMany('App\LogAbsen', 'mapel_id', 'kode_mapel');
    }
}
