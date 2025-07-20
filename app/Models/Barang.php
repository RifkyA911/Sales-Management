<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'T_Barang'; // Nama tabel di database
    protected $primaryKey = 'Kode_Barang'; // Primary key dari tabel ini
    public $incrementing = false; // Primary key bukan auto-incrementing
    protected $keyType = 'string'; // Tipe data primary key adalah string (char)

    // Kolom-kolom yang bisa diisi secara mass assignment
    protected $fillable = [
        'Kode_Barang',
        'Nama_Barang',
        'Harga_Barang',
    ];

    // Jika tidak menggunakan timestamps (created_at, updated_at)
    public $timestamps = false;

    // Relasi: Satu Barang bisa muncul di banyak detail penjualan (T_DJual)
    public function d_juals()
    {
        return $this->hasMany(DJual::class, 'Kode_Barang', 'Kode_Barang');
    }
}
