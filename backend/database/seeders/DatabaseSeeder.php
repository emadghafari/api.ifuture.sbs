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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ifuture.sbs',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            ProductSeeder::class ,
            TeamSeeder::class ,
            SettingSeeder::class ,
        ]);
    }
}
