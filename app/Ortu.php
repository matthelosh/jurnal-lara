<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    protected $fillable = [
                            'nik', 
                            'email', 
                            'hp', 
                            'nama_ayah',
                            'job_ayah',
                            'nama_ibu',
                            'job_ibu',
                            'jl',
                            'desa',
                            'kec',
                            'kab',
                            'prov',
                            'nama_wali',
                            'job_wali',
                            'alamat_wali',
                        ];

    public function siswas()
    {
        return $this->hasMany('App\Siswa', 'ortu_id', 'nik');
    }
}
