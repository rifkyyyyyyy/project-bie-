<?php

namespace Database\Seeders;

use App\Models\Reservasi;
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
        $this->call([ KamarSeeder::class, ReservasiSeeder::class]);
        // User::factory(10)->create();

        User::create([
            'name' => 'Bieplus admin',
            'email' => 'admin@example.com',
            'level' => 'admin',
            'password' => Hash::make('Bieplus123'),
        ]);

        User::create([
            'name' => 'Bieplus Marketing',
            'email' => 'marketing@example.com',
            'level' => 'marketing',
            'password' => Hash::make('Bieplus123'),
        ]);
    }

}