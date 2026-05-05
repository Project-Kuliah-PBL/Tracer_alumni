<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role'     => 'Admin',
        ]);

        // Akun Alumni contoh
        User::create([
            'username' => 'alumni',
            'password' => Hash::make('alumni123'),
            'role'     => 'Alumni',
        ]);
        $this->call([
            DataAlumniSeeder::class,
        ]);
    }
    
}
