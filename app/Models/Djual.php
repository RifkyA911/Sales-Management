<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Djual extends Model
{
    use HasFactory;

    protected $table = 'T_DJual';
    // protected $primaryKey = 'No_Faktur';
    // Primary key adalah komposit, jadi kita tidak set $primaryKey secara tunggal
    // Kita override method setKeysForSaveQuery dan getQualifiedKeyName untuk Eloquent
    // agar bisa bekerja dengan primary key komposit.
    // Namun, cara paling umum untuk PK Komposit adalah dengan tidak mendeklarasikan $primaryKey
    // dan memastikan migrasi sudah benar, serta menggunakan find() dengan array.

    public $incrementing = false; // Primary key bukan auto-incrementing
    protected $keyType = 'string'; // Tipe data primary key adalah string (char)

    // Kolom-kolom yang bisa diisi secara mass assignment
    protected $fillable = [
        'No_Faktur',
        'Kode_Barang',
        'Harga',
        'Qty',
        'Diskon',
        'Bruto',
        'Jumlah',
    ];

    // Jika tidak menggunakan timestamps (created_at, updated_at)
    public $timestamps = false;

    // Relasi: Satu detail penjualan (T_DJual) milik satu transaksi penjualan (T_Jual)
    public function jual()
    {
        return $this->belongsTo(Jual::class, 'No_Faktur', 'No_Faktur');
    }

    // Relasi: Satu detail penjualan (T_DJual) merujuk ke satu Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'Kode_Barang', 'Kode_Barang');
    }

    // =========================================================================
    // KHUSUS UNTUK PRIMARY KEY KOMPOSIT:
    // Eloquent secara default tidak mendukung primary key komposit dengan $primaryKey.
    // Jika kamu ingin menggunakan find($id) atau delete() berdasarkan PK komposit,
    // kamu perlu override beberapa method di model ini.
    // Namun, untuk operasi dasar (insert, update, query builder), ini sudah cukup.
    // Contoh penggunaan find() untuk PK Komposit:
    // TDJual::where('No_Faktur', $noFaktur)->where('Kode_Barang', $kodeBarang)->first();
    // =========================================================================

    // --- Model Events untuk menghitung ulang total ---
    // protected static function booted()
    // {
    //     static::saved(function (DJual $detail) {
    //         // Dipanggil setelah INSERT atau UPDATE
    //         $detail->jual->recalculateTotals();
    //     });

    //     static::deleted(function (DJual $detail) {
    //         // Dipanggil setelah DELETE
    //         $detail->jual->recalculateTotals();
    //     });
    // }
}
