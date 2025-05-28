<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        // VVIP: A-19 s/d A-28
        for ($i = 19; $i <= 28; $i++) {
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

        // VIP Putri: A-01 s/d A-18
        for ($i = 1; $i <= 18; $i++) {
            $data[] = [
                'nomor_kamar' => 'A-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe_kamar' => 'VIP',
                'jenis_kelamin' => 'Perempuan',
                'kapasitas' => 2,
                'terisi' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // VIP Putra: A-29 s/d A-46
        for ($i = 29; $i <= 46; $i++) {
            $data[] = [
                'nomor_kamar' => 'A-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'tipe_kamar' => 'VIP',
                'jenis_kelamin' => 'Laki-laki',
                'kapasitas' => 2,
                'terisi' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // VIP: B dan C
        foreach (['B', 'C'] as $prefix) {
            for ($i = 1; $i <= 50; $i++) {
                $tipe = 'VIP';
                $jenis_kelamin = $i <= 25 ? 'Perempuan' : 'Laki-laki';
                if ($prefix == 'C' && $i > 50) continue;

                $kapasitas = 2;
                if ($prefix == 'C') {
                    $tipe = $i >= 51 ? 'Barack' : 'VIP';
                    $kapasitas = $i >= 51 ? 6 : 2;
                }

                // Skip C-51 & C-52 di loop ini
                if ($prefix == 'C' && ($i == 51 || $i == 52)) continue;

                $data[] = [
                    'nomor_kamar' => $prefix . '-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'tipe_kamar' => $tipe,
                    'jenis_kelamin' => $jenis_kelamin,
                    'kapasitas' => $kapasitas,
                    'terisi' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Barack khusus: C-51 (putri), C-52 (putra)
        $data[] = [
            'nomor_kamar' => 'C-51',
            'tipe_kamar' => 'Barack',
            'jenis_kelamin' => 'Perempuan',
            'kapasitas' => 6,
            'terisi' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $data[] = [
            'nomor_kamar' => 'C-52',
            'tipe_kamar' => 'Barack',
            'jenis_kelamin' => 'Laki-laki',
            'kapasitas' => 6,
            'terisi' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Kamar::insert($data);
    }
}