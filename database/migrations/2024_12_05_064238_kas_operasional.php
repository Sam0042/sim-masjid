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
        Schema::create('kas_operasional', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal transaksi
            $table->foreignId('keterangan_id')->constrained('keterangan_kas')->onDelete('cascade');
            $table->enum('jenis', ['penerimaan', 'pengeluaran','saldo_awal']); // Jenis transaksi
            $table->integer('nominal'); // Jumlah uang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_operasional');
    }
};
