<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(20)->create();
        // Customer::create(['Kode_Customer' => 'AA01', 'Nama_Customer' => 'John Doe']);
        // Customer::create(['Kode_Customer' => 'AA02', 'Nama_Customer' => 'Jane Doe']);
        // Customer::create(['Kode_Customer' => 'AA03', 'Nama_Customer' => 'Mark Smith']);
        // Customer::create(['Kode_Customer' => 'AA04', 'Nama_Customer' => 'William Smith']);
    }
}
