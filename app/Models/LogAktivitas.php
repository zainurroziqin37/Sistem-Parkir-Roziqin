<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'kategori',
        'deskripsi',
        'ip_address'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Helper Static Method untuk mencatat log dengan mudah dari mana saja.
     * Contoh panggil: LogAktivitas::catat('Mencetak tiket parkir B 1234 CD', 'PARKIR');
     */
    public static function catat(string $deskripsi, string $kategori = 'UMUM')
    {
        return self::create([
            'id_user'    => Auth::id(),
            'kategori'   => strtoupper($kategori),
            'deskripsi'  => $deskripsi,
            'ip_address' => Request::ip(),
        ]);
    }
}