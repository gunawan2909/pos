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
        Schema::create('riwayat_persediaans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah')->lenght(100);
            $table->double('nominal');
            $table->foreignId('persediaan_id')->constrained('persediaans');
            $table->foreignId('transaksi_id')->constrained('transaksis');
            $table->string('kuitansi',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_persediaans');
    }
};
