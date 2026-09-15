<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_user'; // Nama tabel kustom kamu

    // Matikan timestamps otomatis karena tb_user tidak punya created_at & updated_at
    public $timestamps = false; 

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_user', 'id');
    }

    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}