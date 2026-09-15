<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_user')->nullable(); // Siapa yang melakukan
            $table->string('kategori')->default('UMUM');     // Contoh: AUTH, PARKIR, USER, TARIF
            $table->text('deskripsi');                       // Detail aksi
            $table->string('ip_address')->nullable();        // Alamat IP pengguna
            $table->timestamps();

            // Foreign key jika ada tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};