<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservasi')->insert([
            [
                'nama_lengkap'    => 'Ahmad Fauzi',
                'jenis_kelamin'   => 'Laki-laki',
                'email'           => 'ahmad@example.com',
                'no_hp'           => '081234567890',
                'asal_kota'       => 'Bandung',
                'periode_masuk'   => '2025-06-01',
                'periode_keluar'  => '2025-06-07',
                'lama_menginap'   => 7,
                'tipe_kamar'      => 'Single',
                'kamar_id'        => 1,
                'is_checked_out'  => false,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'nama_lengkap'    => 'Siti Nurhaliza',
                'jenis_kelamin'   => 'Perempuan',
                'email'           => 'siti@example.com',
                'no_hp'           => '082233445566',
                'asal_kota'       => 'Jakarta',
                'periode_masuk'   => '2025-07-05',
                'periode_keluar'  => '2025-07-12',
                'lama_menginap'   => 7,
                'tipe_kamar'      => 'Deluxe',
                'kamar_id'        => 2,
                'is_checked_out'  => false,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'nama_lengkap'    => 'Budi Santoso',
                'jenis_kelamin'   => 'Laki-laki',
                'email'           => 'budi@example.com',
                'no_hp'           => '081122334455',
                'asal_kota'       => 'Surabaya',
                'periode_masuk'   => '2025-08-15',
                'periode_keluar'  => '2025-08-22',
                'lama_menginap'   => 7,
                'tipe_kamar'      => 'Suite',
                'kamar_id'        => 3,
                'is_checked_out'  => true,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]
        ]);
    }
}
