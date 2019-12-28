<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    protected $fillable = ['nik', 'nama_ortu', 'status', 'job', 'hp', 'jalan', 'desa','kec', 'kab', 'prov', 'email'];

    public function siswas()
    {
        return $this->hasMany('App\Siswa', 'ortu_id', 'nik');
    }
}
