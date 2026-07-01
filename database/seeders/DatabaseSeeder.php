<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KeteranganKasSeeder::class,
            AgendaSeeder::class,
            KategoriGaleriSeeder::class,
            FolderGaleriSeeder::class,
            GaleriSeeder::class,
            ProfilSeeder::class,
            KasOperasionalSeeder::class,
            SaldoAwalSeeder::class,
            KhotibMuazinSeeder::class,
        ]);
    }
}
