<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Bersihkan tabel tb_user agar tidak bentrok (bebas error duplicate)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Masukkan data user baru
        User::create([
            'nama_lengkap' => 'Alwi Shihab',
            'username'     => 'alwi',
            'password'     => Hash::make('alwi123'),
            'role'         => 'admin',
            'status'       => 'aktif',
        ]);

        User::create([
            'nama_lengkap' => 'Haidar Iskandar',
            'username'     => 'haidar',
            'password'     => Hash::make('haidar123'),
            'role'         => 'petugas',
            'status'       => 'aktif',
        ]);

        User::create([
            'nama_lengkap' => 'Yuski Fitroh',
            'username'     => 'yuski',
            'password'     => Hash::make('yuski123'),
            'role'         => 'owner',
            'status'       => 'aktif',
        ]);
    }
}