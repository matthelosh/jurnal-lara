<?php

namespace App\Imports;

use App\Rombel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RombelsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rombel([
            //
            'kode_rombel' => $row['kode_rombel'],
            'nama_rombel' => $row['nama_rombel'],
            'guru_id'     => $row['guru_id']
        ]);
    }
}
