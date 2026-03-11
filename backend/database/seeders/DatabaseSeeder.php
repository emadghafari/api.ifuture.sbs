<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
        ['email' => 'emad.ghafari.92@gmail.com'],
        [
            'name' => 'Emad Ghafari',
            'password' => Hash::make('Emad12@12'),
            'role' => 'admin',
        ]
        );

        $this->call([
            ProductSeeder::class ,
            TeamSeeder::class ,
            SettingSeeder::class ,
        ]);
    }
}
