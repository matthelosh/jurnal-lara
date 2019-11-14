<?php

namespace App\Imports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            //
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'nama_siswa' => $row['nama_siswa'],
            'jk' => $row['jk'],
            'rombel_id' => $row['rombel_id']
        ]);
    }
}
