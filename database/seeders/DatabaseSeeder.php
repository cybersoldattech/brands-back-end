<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BrandsSeeder::class);

        User::query()->create([
            'email' => 'admin@casinoonlinefrancais.info',
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
    }
}
