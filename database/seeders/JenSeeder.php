<?php

namespace Database\Seeders;

use App\Models\Jen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jen::create(['Kode_Tjen' => 'A', 'Nama_Tjen' => 'Kredit']);
        Jen::create(['Kode_Tjen' => 'B', 'Nama_Tjen' => 'Tunai']);
        Jen::create(['Kode_Tjen' => 'C', 'Nama_Tjen' => 'Cicilan']);
        Jen::create(['Kode_Tjen' => 'D', 'Nama_Tjen' => 'Lunas']);
    }
}
