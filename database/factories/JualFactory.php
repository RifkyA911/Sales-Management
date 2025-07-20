<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Jen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jual>
 */
class JualFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pastikan Kode_Customer dan Kode_Tjen sudah ada di database
        // Kita akan mengambilnya secara acak dari yang sudah ada
        $customer = Customer::inRandomOrder()->first();
        $jen = Jen::inRandomOrder()->first();

        // Counter untuk No_Faktur
        static $invoiceCounter = 0;
        $invoiceCounter++;
        $noFaktur = 'INV' . str_pad($invoiceCounter, 3, '0', STR_PAD_LEFT);

        return [
            'No_Faktur' => $noFaktur,
            // Jika customer tidak ditemukan (misal seeder TCustomer belum jalan), akan error
            'Kode_Customer' => $customer ? $customer->Kode_Customer : 'C999', // Fallback jika tidak ada
            'Kode_Tjen' => $jen ? $jen->Kode_Tjen : 'T', // Fallback jika tidak ada
            'Tgl_Faktur' => $this->faker->date(),
            'Total_Bruto' => 0.00, // Awalnya 0, akan di-update nanti
            'Total_Diskon' => 0.00,
            'Total_Jumlah' => 0.00,
        ];
    }
}
