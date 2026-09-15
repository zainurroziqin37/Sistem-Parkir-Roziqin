<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $table = 'tb_area_parkir';
    
    // Tentukan kolom primary key sesuai HeidiSQL
    protected $primaryKey = 'id_area'; 

    public $timestamps = false;

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_area', 'id_area');
    }

    protected $fillable = [
        'nama_area',
        'kapasitas',
        'terisi',
    ];
}