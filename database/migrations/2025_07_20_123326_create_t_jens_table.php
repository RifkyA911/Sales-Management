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
        Schema::create('T_JEN', function (Blueprint $table) {
            $table->char('Kode_Tjen', 1)->primary(); // Primary Key
            $table->char('Nama_Tjen', 10);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('T_JEN');
    }
};
