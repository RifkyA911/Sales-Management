<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('T_Barang', function (Blueprint $table) {
            $table->char('Kode_Barang', 10)->primary(); // Primary Key
            $table->char('Nama_Barang', 20);
            $table->decimal('Harga_Barang', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('T_Barang');
    }
};
