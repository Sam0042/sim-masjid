<?php

namespace Database\Seeders;

use App\Models\KhotibMuazin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhotibMuazinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $datas = [
            [
                'id' => 3, 
                'khotib' => 'Abdul Jamaluddin Hafidz', 
                'muazin' => 'Irsyad', 
                'no_hp' => '082199223743', 
                'tanggal' => '2026-07-10', 
                'updated_at' => '2026-05-26 09:25:57'
            ],
            [
                'id' => 4, 
                'khotib' => 'MUHAMMAD MA\'SUM', 
                'muazin' => 'SATRIA YUDHA', 
                'no_hp' => '0821821084', 
                'tanggal' => '2026-05-29', 
                'updated_at' => null
            ],
            [
                'id' => 5, 
                'khotib' => 'mUHammad ABDUL GHONI', 
                'muazin' => 'ABDUL FATTAH', 
                'no_hp' => '084353591', 
                'tanggal' => '2026-06-05', 
                'updated_at' => null
            ],
            [
                'id' => 6, 
                'khotib' => 'Muhammad Hanif Sulaiman', 
                'muazin' => 'ABDUL FATTAH', 
                'no_hp' => '0821550322', 
                'tanggal' => '2026-06-12', 
                'updated_at' => null
            ],
            [
                'id' => 8, 
                'khotib' => 'UST. MUHAMMAD MA\'SUM, SPdI', 
                'muazin' => 'BpK. SATRIA YUDHA', 
                'no_hp' => '08234124', 
                'tanggal' => '2026-07-03', 
                'updated_at' => null
            ],
            [
                'id' => 9, 
                'khotib' => 'Husni Muhammad', 
                'muazin' => 'Bambang Hariyanto', 
                'no_hp' => '08212224341', 
                'tanggal' => '2026-06-19', 
                'updated_at' => null
            ],
            [
                'id' => 10, 
                'khotib' => 'Husni Muhammad', 
                'muazin' => 'Irsyad Jamaluddin', 
                'no_hp' => null, 
                'tanggal' => '2026-08-28', 
                'updated_at' => null
            ],
        ];

        foreach ($datas as $data) {
            DB::table('khotib_muazins')->insert([
                'id'         => $data['id'],
                'khotib'     => $data['khotib'],
                'muazin'     => $data['muazin'],
                'no_hp'      => $data['no_hp'],
                'tanggal'    => $data['tanggal'],
                'created_at' => now(), // Mengisi waktu saat ini
                'updated_at' => $data['updated_at']
            ]);
        }
    }
}

