<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        // VVIP: A-01 s/d A-46
        for ($i = 1; $i <= 46; $i++) {
            $data[] = [
                'nomor_kamar' => 'A-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe_kamar' => 'VVIP',
                'jenis_kelamin' => $i <= 23 ? 'Perempuan' : 'Laki-laki',
                'kapasitas' => 2,
                'terisi' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // VIP: B-01 s/d B-50
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'nomor_kamar' => 'B-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe_kamar' => 'VIP',
                'jenis_kelamin' => $i <= 25 ? 'Perempuan' : 'Laki-laki',
                'kapasitas' => 2,
                'terisi' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Barack: C-01 s/d C-50
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'nomor_kamar' => 'C-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe_kamar' => 'Barack',
                'jenis_kelamin' => $i <= 25 ? 'Perempuan' : 'Laki-laki',
                'kapasitas' => 6,
                'terisi' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Kamar::insert($data);
    }
}