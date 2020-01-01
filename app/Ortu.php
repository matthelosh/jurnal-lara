<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    protected $fillable = [
                            'nik_aktif', 
                            'email_aktif',
                            'nama_ayah',
                            'job_ayah',
                            'alamat_ayah',
                            'hp_ayah',
                            'nama_ibu',
                            'job_ibu',
                            'alamat_ibu',
                            'hp_ibu',
                            'nama_wali',
                            'job_wali',
                            'alamat_wali',
                            'hp_wali',
                        ];

    public function siswas()
    {
        return $this->hasMany('App\Siswa', 'ortu_id', 'nik');
    }
}
