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
        Schema::create('T_Djual', function (Blueprint $table) {
            // Kolom Primary Key (Komposit)
            // Di ERD ini, No_Faktur dan Kode_Barang bersama-sama menjadi primary key
            // karena dalam satu nota, satu barang hanya bisa muncul sekali.
            $table->char('No_Faktur', 6);
            $table->char('Kode_Barang', 10);

            // Kolom-kolom lainnya
            $table->decimal('Harga', 15, 2);
            $table->decimal('Qty', 15, 2);
            // Tapi sesuai ERD, kita pakai decimal.
            $table->decimal('Diskon', 15, 2);
            $table->decimal('Bruto', 15, 2);
            $table->decimal('Jumlah', 15, 2);

            // Definisi Primary Key Komposit
            $table->primary(['No_Faktur', 'Kode_Barang']);

            // Definisi Foreign Keys
            // Merujuk ke tabel t_juals
            $table->foreign('No_Faktur')->references('No_Faktur')->on('T_Jual')->onUpdate('cascade')
                ->onDelete('cascade'); // Opsi: jika nota dihapus, detail juga ikut dihapus

            // Merujuk ke tabel t_barangs
            $table->foreign('Kode_Barang')->references('Kode_Barang')->on('T_Barang')
                ->onDelete('restrict'); // Opsi: tidak boleh hapus barang jika sudah ada di detail transaksi
            // atau bisa juga 'set null' kalau memang memungkinkan
            // $table->timestamps(); // Kalau perlu created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('T_Djual');
    }
};
