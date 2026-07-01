<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [

            [
                'id' => 1,
                'nama' => 'Sunat Massal September',
                'deskripsi' => 'Sunat Massal September merupakan kegiatan sosial yang diselenggarakan untuk memberikan layanan khitan gratis kepada anak-anak di lingkungan sekitar. Program ini bertujuan membantu meringankan beban masyarakat, sekaligus menumbuhkan semangat kebersamaan dan kepedulian. Kegiatan akan dilaksanakan dengan melibatkan tenaga medis profesional serta didukung oleh berbagai pihak, sehingga diharapkan dapat memberikan manfaat kesehatan sekaligus menjadi momentum kebahagiaan bagi anak-anak dan keluarga.',
                'tanggal_mulai' => '2026-05-09 17:00:00',
                'tanggal_selesai' => '2026-05-11 20:00:00',
                'lokasi' => 'Masjid Roudhotul Jannah',
                'foto' => '1778047376-1.jpeg',
            ],

            [
                'id' => 2,
                'nama' => 'Kerja Bakti Bersih-Bersih Masjid',
                'deskripsi' => 'Kegiatan gotong royong membersihkan area dalam dan sekitar masjid agar tetap nyaman digunakan untuk beribadah.',
                'tanggal_mulai' => '2026-05-09 08:30:00',
                'tanggal_selesai' => '2026-05-10 06:00:00',
                'lokasi' => 'Masjid Roudhotul Jannah',
                'foto' => '1778047539-9.jpeg',
            ],

            [
                'id' => 3,
                'nama' => 'Bakti Sosial dan Santunan Anak Yatim',
                'deskripsi' => 'Kegiatan berbagi dengan anak yatim dan kaum dhuafa di lingkungan sekitar masjid, disertai doa bersama.',
                'tanggal_mulai' => '2026-05-09 10:19:00',
                'tanggal_selesai' => '2026-05-09 12:00:00',
                'lokasi' => 'Masjid Roudhotul Jannah',
                'foto' => '1778047306-10.jpeg',
            ],

            

        ];

        foreach ($datas as $data) {

            $agenda = new Agenda();

            $agenda->id = $data['id'];
            $agenda->nama = $data['nama'];
            $agenda->deskripsi = $data['deskripsi'];
            $agenda->tanggal_mulai = $data['tanggal_mulai'];
            $agenda->tanggal_selesai = $data['tanggal_selesai'];
            $agenda->lokasi = $data['lokasi'];
            $agenda->foto = $data['foto'];

            $agenda->save();
        }
    }
}