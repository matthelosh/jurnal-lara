<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            //
            'nip' => $row['nip'],
            'username' => $row['username'],
            'fullname' => $row['fullname'],
            'password' => Hash::make($row['password']),
            'email' => $row['email'],
            'hp' => $row['hp'],
            'level' => $row['level']

        ]);
    }
}
