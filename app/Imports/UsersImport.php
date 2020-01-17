<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'nip' => $row['nip'],
            'username' => $row['username'],
            'fullname' => $row['fullname'],
            'password' => Hash::make($row['password']),
            'api_token' => Str::random(60),
            'email' => $row['email'],
            'hp' => $row['hp'],
            'level' => $row['level'],
            'jk' => $row['jk'],
            'role' => $row['role']
        ]);
    }
}
