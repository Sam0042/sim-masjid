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
        Schema::create('folder_galeris', function (Blueprint $table) {
            $table->id();
             $table->foreignId('kategori_galeri_id')
            ->constrained('kategori_galeris')
            ->onDelete('cascade');
            $table->string('nama');
            $table->string('thumbnail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folder_galeris');
    }
};
