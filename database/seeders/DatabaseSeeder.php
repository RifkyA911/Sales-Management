<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan sangat penting!
        // Tabel tanpa foreign key harus di-seed duluan
        $this->call([
            JenSeeder::class,      // Kode_Tjen di T_Jual
            CustomerSeeder::class, // Kode_Customer di T_Jual
            BarangSeeder::class,   // Kode_Barang di T_D_Jual

            // JualSeeder::class,     // No_Faktur di T_D_Jual, dan butuh TJen, TCustomer
            // TDJualSeeder::class, // Tidak perlu lagi karena TDJual dibuat di TJualSeeder
        ]);
    }
}
