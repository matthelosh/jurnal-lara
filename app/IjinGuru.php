<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IjinGuru extends Model
{
    //
    protected $fillable = ['kode_absen', 'tanggal', 'keperluan', 'tugas_siswa', 'ket'];
}
