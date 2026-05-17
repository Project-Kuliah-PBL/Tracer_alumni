<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'role'     => 'SuperAdmin',
                'prodi'    => null,
            ]
        );

        $this->command->info('Akun SuperAdmin berhasil dibuat. Username: admin | Password: admin123');
    }
}
