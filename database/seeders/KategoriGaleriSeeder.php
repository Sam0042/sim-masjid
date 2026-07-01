<?php

namespace Database\Seeders;

use App\Models\KategoriGaleri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriGaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [

            [
                'nama' => 'Kegiatan',
                'thumbnail' => 'thumbnail1.jpg',
            ],

            [
                'nama' => 'Fasilitas',
                'thumbnail' => 'thumbnail2.jpg',
            ],

            [
                'nama' => 'Kajian',
                'thumbnail' => 'thumbnail3.jpg',
            ],

        ];

        foreach ($datas as $data) {

            $data_final = new KategoriGaleri();

            $data_final->nama = $data['nama'];

            $data_final->thumbnail = $data['thumbnail'];

            $data_final->save();
        }
    }
}