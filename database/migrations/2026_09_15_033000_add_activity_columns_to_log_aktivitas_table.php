<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('log_aktivitas', function (Blueprint $table) {
            if (! Schema::hasColumn('log_aktivitas', 'kategori')) {
                $table->string('kategori')->default('UMUM')->after('id_user');
            }

            if (! Schema::hasColumn('log_aktivitas', 'deskripsi')) {
                $table->text('deskripsi')->after('kategori');
            }

            if (! Schema::hasColumn('log_aktivitas', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('deskripsi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('log_aktivitas', function (Blueprint $table) {
            $columns = [];

            foreach (['kategori', 'deskripsi', 'ip_address'] as $column) {
                if (Schema::hasColumn('log_aktivitas', $column)) {
                    $columns[] = $column;
                }
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
