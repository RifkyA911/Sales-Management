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
        Schema::create('T_Customer', function (Blueprint $table) {
            $table->char('Kode_Customer', 4)->primary(); // Primary Key
            $table->char('Nama_Customer', 40);
            // $table->timestamps(); // Kalau perlu created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('T_Customer');
    }
};
