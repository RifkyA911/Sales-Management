<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    use HasFactory;

    protected $table = 'T_Jual';
    protected $primaryKey = 'No_Faktur';
    public $incrementing = false; // Karena No_Faktur bukan auto-increment
    protected $keyType = 'string'; // Karena No_Faktur adalah char
    protected $fillable = [
        'No_Faktur',
        'Kode_Customer',
        'Kode_Tjen',
        'Tgl_Faktur',
        'Total_Bruto',
        'Total_Diskon',
        'Total_Jumlah'
    ];

    public $timestamps = false;

    // Relasi: Satu transaksi penjualan (T_Jual) milik satu Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Kode_Customer', 'Kode_Customer');
    }

    // Relasi: Satu transaksi penjualan (T_Jual) milik satu Jenis (T_JEN)
    public function jen()
    {
        return $this->belongsTo(Jen::class, 'Kode_Tjen', 'Kode_Tjen');
    }

    // Relasi: Satu transaksi penjualan (T_Jual) punya banyak detail (T_DJual)
    public function details() //d_juals
    {
        return $this->hasMany(Djual::class, 'No_Faktur', 'No_Faktur');
    }


    // ------------------------------ SEEDER FUNC && TIRGER OPTION ------------------------------
    // // Fungsi untuk menghitung ulang dan mengupdate total
    public function recalculateTotals()
    {
        $totalBruto = $this->details->sum('Bruto');
        $totalDiskon = $this->details->sum('Diskon');
        $totalJumlah = $this->details->sum('Jumlah');

        // Penting: gunakan updateQuietly() atau disable events
        // agar tidak terjadi loop rekursif jika ada event di TJual
        $this->updateQuietly([
            'Total_Bruto' => $totalBruto,
            'Total_Diskon' => $totalDiskon,
            'Total_Jumlah' => $totalJumlah,
        ]);
        // Atau:
        // $this->Total_Bruto = $totalBruto;
        // $this->Total_Diskon = $totalDiskon;
        // $this->Total_Jumlah = $totalJumlah;
        // $this->save(['timestamps' => false]); // Matikan timestamps jika tidak ingin updated_at berubah
    }
}
