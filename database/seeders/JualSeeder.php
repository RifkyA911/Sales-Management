<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Djual;
use App\Models\Jual;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 50 transaksi penjualan
        Jual::factory()
            ->count(50)
            ->create()
            ->each(function ($jual) {
                // Untuk setiap transaksi jual, buat beberapa item detail penjualan
                // Ambil beberapa barang secara acak, pastikan tidak ada duplikat dalam satu transaksi
                $barangs = Barang::inRandomOrder()->limit(rand(1, 5))->get(); // 1-5 item per nota
    
                foreach ($barangs as $barang) {
                    Djual::factory()
                        ->state([ // Mengisi No_Faktur dan Kode_Barang yang spesifik
                            'No_Faktur' => $jual->No_Faktur,
                            'Kode_Barang' => $barang->Kode_Barang,
                        ])
                        ->withBarangPrice($barang) // Menggunakan harga dari barang yang dipilih
                        ->create();
                }
            });

        // --- Opsional: Recalculate Totals (Karena tidak pakai trigger/event di model) ---
        Jual::all()->each(function ($jual) {
            $jual->recalculateTotals(); // Panggil method yang ada di model TJual
        });
    }
}
