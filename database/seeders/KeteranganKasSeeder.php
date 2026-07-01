<?php

namespace Database\Seeders;

use App\Models\KeteranganKas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeteranganKasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['id' => 1, 'keterangan' => 'Kotak Amal'],
            ['id' => 2, 'keterangan' => 'Transport Khotib'],
            ['id' => 3, 'keterangan' => 'Tahsin Sabtu'],
            ['id' => 4, 'keterangan' => 'Insentif khotib cadangan Muazin'],
            ['id' => 5, 'keterangan' => 'Sahur'],
        ];

        foreach ($datas as $data) {
            $data_final = new KeteranganKas;
            $data_final->keterangan = $data['keterangan'];
            $data_final->save();
        }
    }
}
