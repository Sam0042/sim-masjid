<?php

namespace Database\Seeders;


use App\Models\Galeris;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [

            [
                'nama' => 'Bagian dalam masjid',
                'foto' => 'foto-68d224ad2d5a9.jpg',
                'folder_galeri_id' => 1,
            ],

            [
                'nama' => 'Teras kanan masjid',
                'foto' => 'foto-6912e49b593a6.jpg',
                'folder_galeri_id' => 2,
            ],

            [
                'nama' => 'Depan tempat wudhu',
                'foto' => 'foto-6912ea4c01325.jpg',
                'folder_galeri_id' => 2,
            ],

            [
                'nama' => 'Parkiran depan masjid',
                'foto' => 'foto-6912eb017a2d3.jpg',
                'folder_galeri_id' => 1,
            ],

            [
                'nama' => 'Gerbang masjid',
                'foto' => 'foto-6912ef7941d01.jpg',
                'folder_galeri_id' => 2,
            ],

        ];

        foreach ($datas as $data) {

            $galeri = new Galeris();

            $galeri->nama = $data['nama'];
            $galeri->foto = $data['foto'];
            $galeri->folder_galeri_id = $data['folder_galeri_id'];

            $galeri->save();
        }
    }
}