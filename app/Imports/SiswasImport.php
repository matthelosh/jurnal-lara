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

    // 'nis', 'nisn', 'nama_siswa', 'jk', 'rombel_id', 'foto','ortu_id', 'jalan', 'desa', 'kec', 'kab', 'prov', 'hp', 'email'
    public function model(array $row)
    {
        return new Siswa([
            //
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'nama_siswa' => $row['nama_siswa'],
            'jk' => $row['jk'],
            'rombel_id' => $row['rombel_id'],
            'foto' => $row['foto'],
            'ortu_id' => $row['ortu_id'],
            'jalan' => $row['jalan'],
            'desa' => $row['desa'],
            'kec' => $row['kec'],
            'kab' => $row['kab'],
            'prov' => $row['prov'],
            'hp' => $row['hp'],
            'email' => $row['email']
        ]);
    }
}
