<?php

namespace Database\Seeders;

use App\Models\FolderGaleri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderGaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [

            [
                'kategori_galeri_id' => 1,
                'nama' => 'Sholat Ied 2024',
                'thumbnail' => 'thumbnail1.jpg',
            ],

            [
                'kategori_galeri_id' => 1,
                'nama' => 'Kerja Bakti Mei 2025',
                'thumbnail' => 'thumbnail2.jpg',
            ],

            [
                'kategori_galeri_id' => 2,
                'nama' => 'Ruang Utama Masjid',
                'thumbnail' => 'thumbnail3.jpg',
            ],

            [
                'kategori_galeri_id' => 2,
                'nama' => 'Tempat Wudhu',
                'thumbnail' => 'thumbnail4.jpg',
            ],

        ];

        foreach ($datas as $data) {

            $data_final = new FolderGaleri();

            $data_final->kategori_galeri_id = $data['kategori_galeri_id'];
            $data_final->nama = $data['nama'];
            $data_final->thumbnail = $data['thumbnail'];

            $data_final->save();
        }
    }
}