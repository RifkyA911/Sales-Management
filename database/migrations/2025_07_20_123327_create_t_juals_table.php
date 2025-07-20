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
        Schema::create('T_Jual', function (Blueprint $table) {
            $table->char('No_Faktur', 6)->primary();
            $table->char('Kode_Customer', 4); // Foreign Key
            $table->char('Kode_Tjen', 1);     // Foreign Key
            $table->date('Tgl_Faktur');
            $table->decimal('Total_Bruto', 15, 2);
            $table->decimal('Total_Diskon', 15, 2);
            $table->decimal('Total_Jumlah', 15, 2);
            // $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('Kode_Customer')->references('Kode_Customer')->on('T_Customer');
            $table->foreign('Kode_Tjen')->references('Kode_Tjen')->on('T_JEN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('T_Jual');
    }
};
