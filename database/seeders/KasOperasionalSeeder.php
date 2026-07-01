<?php

namespace Database\Seeders;

use App\Models\KasOperasional;
use Illuminate\Database\Seeder;

class KasOperasionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['tanggal' => '2026-05-08', 'keterangan_id' => 1, 'jenis' => 'penerimaan', 'nominal' => 320000],
            ['tanggal' => '2026-05-01', 'keterangan_id' => 2, 'jenis' => 'pengeluaran', 'nominal' => 200000],
            ['tanggal' => '2026-05-08', 'keterangan_id' => 2, 'jenis' => 'pengeluaran', 'nominal' => 200000],
            ['tanggal' => '2026-05-01', 'keterangan_id' => 4, 'jenis' => 'pengeluaran', 'nominal' => 200000],
            ['tanggal' => '2026-04-03', 'keterangan_id' => 1, 'jenis' => 'penerimaan', 'nominal' => 1520000],
            ['tanggal' => '2026-05-01', 'keterangan_id' => 1, 'jenis' => 'penerimaan', 'nominal' => 2130500],
        ];

        foreach ($datas as $data) {

            $kas = new KasOperasional();

            $kas->tanggal = $data['tanggal'];
            $kas->keterangan_id = $data['keterangan_id'];
            $kas->jenis = $data['jenis'];
            $kas->nominal = $data['nominal'];

            $kas->save();
        }
    }
}