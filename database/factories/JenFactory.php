<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jen>
 */
class JenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Untuk Kode_Jen (char(4)), kita bisa pakai sequence atau kombinasi huruf/angka
        // Agar unik, kita bisa menggunakan unique() faker atau sequence untuk memastikan id unik
        static $jenCounter = 0; // Static counter untuk Kode_Jen
        $jenCounter++;
        $kodeJen = 'JN' . str_pad($jenCounter, 3, '0', STR_PAD_LEFT);

        return [
            // Pastikan Kode_Jen unik dan sesuai format char(4)
            'Kode_Jen' => $kodeJen,
            'Nama_Jen' => $this->faker->unique()->randomWord(),
        ];
    }
}
