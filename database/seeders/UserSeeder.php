<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing users to avoid unique constraint errors if re-running
        User::whereIn('email', ['admin@nusantara.com', 'user@example.com'])->delete();

        User::create([
            'name' => 'Admin Nusantara',
            'username' => 'admin',
            'email' => 'admin@nusantara.com',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'Pengguna Baru',
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
