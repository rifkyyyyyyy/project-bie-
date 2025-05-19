<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_lengkap' => 'Mochammad Rifky Alfiansyah',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'rifky@mail.com',
                'no_hp' => '081234567891',
                'asal_kota' => 'Surabaya',
                'periode_masuk' => '2025-06-01',
                'periode_keluar' => '2025-06-07',
                'lama_menginap' => 7,
                'tipe_kamar' => 'VVIP',
                'kamar_id' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Rica Rahmahidayatul',
                'jenis_kelamin' => 'Perempuan',
                'email' => 'rica@mail.com',
                'no_hp' => '082233445566',
                'asal_kota' => 'Sidoarjo',
                'periode_masuk' => '2025-05-10',
                'periode_keluar' => '2025-05-13',
                'lama_menginap' => 3,
                'tipe_kamar' => 'VIP',
                'kamar_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Ahmad Affandi',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'affandi@mail.com',
                'no_hp' => '081122334455',
                'asal_kota' => 'Bondowoso',
                'periode_masuk' => '2025-06-05',
                'periode_keluar' => '2025-06-06',
                'lama_menginap' => 1,
                'tipe_kamar' => 'VIP',
                'kamar_id' => 72,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Rahmahidayatul Rica',
                'jenis_kelamin' => 'Perempuan',
                'email' => 'rahamahidayatul@mail.com',
                'no_hp' => '083344556677',
                'asal_kota' => 'Yogyakarta',
                'periode_masuk' => '2025-06-03',
                'periode_keluar' => '2025-06-06',
                'lama_menginap' => 3,
                'tipe_kamar' => 'VIP',
                'kamar_id' => 53,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Irsyad Romadloni',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'Irsyad@mail.com',
                'no_hp' => '084455667788',
                'asal_kota' => 'Jombang',
                'periode_masuk' => '2025-05-15',
                'periode_keluar' => '2025-05-22',
                'lama_menginap' => 7,
                'tipe_kamar' => 'Barack',
                'kamar_id' => 136,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Aswita',
                'jenis_kelamin' => 'Perempuan',
                'email' => 'aswita@mail.com',
                'no_hp' => '085566778899',
                'asal_kota' => 'Mojokerto',
                'periode_masuk' => '2025-06-11',
                'periode_keluar' => '2025-06-14',
                'lama_menginap' => 3,
                'tipe_kamar' => 'Barack',
                'kamar_id' => 108,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('reservasi')->insert($data);
    }
}