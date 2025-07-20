<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jen extends Model
{
    use HasFactory;

    protected $table = 'T_Jen';
    protected $primaryKey = 'Kode_Tjen';
    public $incrementing = false; // Karena Kode_Tjen bukan auto-increment
    protected $keyType = 'string'; // Karena Kode_Tjen adalah char
    protected $fillable = ['Kode_Tjen', 'Nama_Tjen'];
    public $timestamps = false;

    // Relasi: Satu Jenis bisa terkait dengan banyak transaksi penjualan (T_Jual)
    public function juals()
    {
        return $this->hasMany(Jual::class, 'Kode_Tjen', 'Kode_Tjen');
    }
}
