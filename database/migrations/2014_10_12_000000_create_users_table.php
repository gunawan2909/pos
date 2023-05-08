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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->integer('nis')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('foto')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('nik')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('token_no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->string('no_wali')->nullable();
            $table->string('universitas')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('prodi')->nullable();
            $table->string('tahun_masuk')->nullable();
            $table->string('program')->nullable();
            $table->string('kelas_id')->nullable();
            $table->string('komplek_id')->nullable();
            $table->string('remote')->default('1');
            $table->string('status')->default('belum lunas pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
