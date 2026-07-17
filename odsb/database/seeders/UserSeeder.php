<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'role' => 'Admin',
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin123',
            ],
            [
                'role' => 'SPV',
                'name' => 'Supervisor',
                'username' => 'spv',
                'email' => 'spv@gmail.com',
                'password' => 'spv123',
            ],
            [
                'role' => 'Direct Sales',
                'name' => 'Direct Sales',
                'username' => 'ds',
                'email' => 'ds@gmail.com',
                'password' => 'ds123',
            ],
        ];

        foreach ($users as $data) {
            $role = Role::where('name', $data['role'])->first();

            User::updateOrCreate(
                ['username' => $data['username']],
                [
                    'role_id' => $role->id,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => null,
                    'telegram_chat_id' => null,
                    'telegram_username' => null,
                    'password' => $data['password'], // otomatis di-hash
                    'is_active' => true,
                ]
            );
        }
    }
}