<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Djual>
 */
class DJualFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // No_Faktur dan Kode_Barang akan disuplai dari seeder
        // Kita hanya akan mengisi kolom-kolom detail lainnya
        $qty = $this->faker->numberBetween(1, 5);
        $harga = $this->faker->randomFloat(2, 5000, 50000); // Default random
        $diskon = $this->faker->randomElement([0, (int) ($harga * 0.01)]); // Diskon kecil

        $bruto = $harga * $qty;
        $jumlah = $bruto - $diskon;

        return [
            // No_Faktur dan Kode_Barang akan disuplai dari seeder
            'Harga' => $harga,
            'Qty' => $qty,
            'Diskon' => $diskon,
            'Bruto' => $bruto,
            'Jumlah' => $jumlah,
        ];
    }

    // Metode untuk mengoverride harga barang agar sesuai dengan TBarang
    public function withBarangPrice($barang)
    {
        return $this->state(function (array $attributes) use ($barang) {
            $qty = $this->faker->numberBetween(1, 5);
            $harga = $barang->Harga_Barang;
            $bruto = $harga * $qty;

            // Diskon max 20% dari bruto atau maksimal Rp100.000
            $diskonPersen = $this->faker->randomElement([0, 10, 20]); // 0%, 10%, 20%
            $diskon = min($bruto * ($diskonPersen / 100), 100000);

            $jumlah = max($bruto - $diskon, 0); // jangan sampai negatif

            return [
                'Harga' => $harga,
                'Qty' => $qty,
                'Diskon' => $diskon,
                'Bruto' => $bruto,
                'Jumlah' => $jumlah,
            ];
        });
    }

}
