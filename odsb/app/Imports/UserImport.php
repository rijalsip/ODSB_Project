<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class UserImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {
        $username = trim($row['username'] ?? '');
        $idDigipos = trim($row['id_digipos'] ?? '');

        // Lewati jika baris kosong
        if ($username === '' && $idDigipos === '') {
            return null;
        }

        $role = null;

        if (!empty($row['role'])) {
            $role = Role::where('name', trim($row['role']))->first();
        }

        $key = $idDigipos !== ''
            ? ['id_digipos' => $idDigipos]
            : ['username' => $username];

        return User::updateOrCreate(
            $key,
            [
                'role_id' => $role?->id,
                'name' => trim($row['nama'] ?? ''),
                'username' => $username,
                'id_digipos' => $idDigipos ?: null,
                'cluster' => trim($row['cluster'] ?? ''),
                'phone' => trim($row['phone'] ?? ''),
                'telegram_username' => !empty($row['telegram_username'])
                    ? trim($row['telegram_username'])
                    : null,
                'email' => $idDigipos !== ''
                    ? $idDigipos . '@digipos.local'
                    : $username . '@digipos.local',
                'password' => Hash::make('Telkomsel@123'),
                'is_active' => true,
            ]
        );
    }
}