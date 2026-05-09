<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role'     => 'Admin',
        ]);

        // 2. Daftar NIM Alumni untuk pembuatan akun massal
        $alumniNims = [
            'E41212139', 'E41212060', 'E41212058', 'E41212403', 'E41212105',
            'E41212037', 'E41212125', 'E41212270', 'E41212359', 'E41212003',
            'E41212012', 'E41212081', 'E41212055', 'E41211962', 'E41212204',
            'E41212015', 'E41212007', 'E41212044', 'E41212250', 'E41212079',
            'E41211994', 'E41212126', 'E41212137', 'E41212165', 'E41211990',
            'E41212132', 'E41212057', 'E41212027', 'E41212272', 'E41212028',
            'E41212120', 'E41212161', 'E41212006', 'E41212026', 'E41212013',
            'E41212201', 'E41212260', 'E41212104', 'E41212093'
        ];

        foreach ($alumniNims as $nim) {
            User::create([
                'username' => $nim,
                'password' => Hash::make($nim), // Password default adalah NIM masing-masing
                'role'     => 'Alumni',
            ]);
        }

        // 3. Memanggil seeder data profil alumni
        $this->call([
            DataAlumniSeeder::class,
        ]);
    }
}