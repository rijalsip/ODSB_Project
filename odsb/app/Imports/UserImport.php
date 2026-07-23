<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
   public function model(array $row)
{
    $role = null;

    if (!empty($row['role'])) {
        $role = Role::where('name', trim($row['role']))->first();
    }

    $idDigipos = trim($row['id_digipos'] ?? '');
    $username = trim($row['username'] ?? '');

    $key = !empty($idDigipos)
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
            'telegram_username' => trim($row['telegram_username'] ?? '') ?: null,
            'email' => !empty($idDigipos)
                ? $idDigipos . '@digipos.local'
                : $username . '@digipos.local',
            'password' => Hash::make('Telkomsel@123'),
            'is_active' => true,
        ]
    );
}
}