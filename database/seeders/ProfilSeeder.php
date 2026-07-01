<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [

            [
                'sejarah' => 'Menjadikan ma',
                'foto_sejarah' => 'foto_sejarah.jpg',
                'visi' => 'Menjadikan masjid sebagai pusat peradaban Islam yang unggul, memakmurkan jamaah melalui penguatan iman dan ibadah, serta menjadi pusat pemberdayaan umat yang harmonis, inklusif, dan berwawasan lingkungan dalam bingkai ukhuwah islamiyah yang kokoh.',

                'misi' => 'Menyelenggarakan kegiatan ibadah yang khusyuk dan berkualitas, melaksanakan program pendidikan dakwah yang moderat untuk mencerdaskan generasi umat, serta mengelola manajemen masjid secara transparan dan profesional guna memberikan pelayanan sosial, ekonomi, dan kemasyarakatan yang bermanfaat bagi seluruh warga sekitar.',

                'foto_struktur' => 'foto_struktur.jpg',

                'alamat' => 'Kabupaten Bogor, Kecamatan Bojonggede, Desa Rawapanjang, Perumahan Taman Raya Citayam, Jl Edelia Blok E5 RT.07 RW.12.',

                'telepon' => '08212412777',

                'instagram' => 'masjidjamiroudhotuljannah',
            ],

        ];

        foreach ($datas as $data) {

            $profil = new Profil();

            $profil->sejarah = $data['sejarah'];
            $profil->foto_sejarah = $data['foto_sejarah'];
            $profil->visi = $data['visi'];
            $profil->misi = $data['misi'];

            $profil->foto_struktur = $data['foto_struktur'];

            $profil->alamat = $data['alamat'];
            $profil->telepon = $data['telepon'];
            $profil->instagram = $data['instagram'];

            $profil->save();
        }
    }
}