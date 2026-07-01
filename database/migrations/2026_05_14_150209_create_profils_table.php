<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            // PROFIL MASJID
            $table->string('sejarah')->nullable();
            $table->string('foto_sejarah')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();

            // STRUKTUR ORGANISASI
            $table->string('foto_struktur')->nullable();

            // INFORMASI KONTAK
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();

            // SOSIAL MEDIA
            $table->string('instagram')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
