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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('senin_shif');
            $table->string('senin_absen');
            $table->string('selasa_shif');
            $table->string('selasa_absen');
            $table->string('rabu_shif');
            $table->string('rabu_absen');
            $table->string('kamis_shif');
            $table->string('kamis_absen');
            $table->string('jumat_shif');
            $table->string('jumat_absen');
            $table->string('sabtu_shif');
            $table->string('sabtu_absen');
            $table->string('minggu_shif');
            $table->string('minggu_absen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
