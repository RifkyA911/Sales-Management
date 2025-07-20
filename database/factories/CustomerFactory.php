<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Untuk Kode_Customer (char(4)), kita bisa pakai sequence atau kombinasi huruf/angka
        // Agar unik, kita bisa menggunakan unique() faker atau sequence untuk memastikan id unik
        static $customerCounter = 0; // Static counter untuk Kode_Customer
        $customerCounter++;
        $kodeCustomer = 'C' . str_pad($customerCounter, 3, '0', STR_PAD_LEFT);

        return [
            // Pastikan Kode_Customer unik dan sesuai format char(4)
            'Kode_Customer' => $kodeCustomer,
            'Nama_Customer' => $this->faker->name(),
        ];
    }
}
