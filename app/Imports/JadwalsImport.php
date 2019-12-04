<?php

namespace App\Imports;

use App\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jadwal([
            //
            'kode_jadwal' => $row['kode_jadwal'],
            'hari' => $row['hari'],
            'guru_id' => $row['guru_id'],
            'mapel_id' => $row['mapel_id'],
            'rombel_id' => $row['rombel_id'],
            'jamke' => $row['jamke']
        ]);
    }
}
