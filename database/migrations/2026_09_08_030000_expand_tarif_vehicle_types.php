<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tb_tarif MODIFY jenis_kendaraan ENUM('motor', 'mobil', 'truk', 'lainnya') NULL");
    }

    public function down(): void
    {
        DB::statement("UPDATE tb_tarif SET jenis_kendaraan = 'lainnya' WHERE jenis_kendaraan = 'truk'");
        DB::statement("ALTER TABLE tb_tarif MODIFY jenis_kendaraan ENUM('motor', 'mobil', 'lainnya') NULL");
    }
};
