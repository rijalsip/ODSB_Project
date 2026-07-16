<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'description' => 'Mengelola seluruh data sistem',
            ],
            [
                'name' => 'SPV',
                'description' => 'Melihat dan memonitor data selling',
            ],
            [
                'name' => 'Direct Sales',
                'description' => 'Melakukan input hasil selling',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                [
                    'description' => $role['description'],
                    'is_active' => true,
                ]
            );
        }
    }
}
