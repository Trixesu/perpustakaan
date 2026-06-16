<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User admin 
        User::create([
            'name'     => 'admin',
            'email'    => 'admin@perpustakaan.com',
            'password' => Hash::make('admin_p4ss'),
        ]);

        // User tambahan 
        User::create([
            'name'     => 'petugas',
            'email'    => 'petugas@perpustakaan.com',
            'password' => Hash::make('petugas123'),
        ]);
    }
}
