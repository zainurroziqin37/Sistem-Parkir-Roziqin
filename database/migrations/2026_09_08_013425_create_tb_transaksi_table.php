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
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id('id_parkir');
            $table->string('id_kendaraan', 50)->nullable();
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->unsignedBigInteger('id_tarif')->nullable();
            $table->integer('durasi_jam')->default(0);
            $table->integer('biaya_total')->default(0);
            $table->enum('status', ['masuk', 'keluar'])->default('masuk');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_area')->nullable();

            // Foreign Key Constraints
            $table->foreign('id_tarif')->references('id_tarif')->on('tb_tarif')->onDelete('cascade');
            $table->foreign('id_area')->references('id_area')->on('tb_area_parkir')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('tb_user')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
