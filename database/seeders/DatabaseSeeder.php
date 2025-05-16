<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RoomAndBookingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        KamarSeeder::class,
        // tambahkan seeder lain jika ada
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Bieplus',
            'email' => 'test@example.com',
            'password' => Hash::make('Bieplus123'),
        ]);
    }

}