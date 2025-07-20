<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Untuk Kode_Barang (char(10)), gunakan kombinasi huruf/angka unik
        // Pastikan panjangnya tidak melebihi 10 karakter
        return [
            'Kode_Barang' => $this->faker->unique()->lexify('BRG???????'), // BRG + 7 huruf acak
            'Nama_Barang' => $this->faker->word() . ' ' . $this->faker->randomElement(['A', 'B', 'C', 'Besar', 'Kecil', 'Premium']),
            'Harga_Barang' => $this->faker->randomFloat(2, 1000, 100000), // Harga antara 1000 - 100.000
        ];
    }
}
