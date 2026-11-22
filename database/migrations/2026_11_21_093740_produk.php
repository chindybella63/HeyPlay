<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('id_produk', 20)->nullable()->unique(); // kode otomatis: PRD-0001
            $table->string('nama_produk', 100);
            $table->string('jenis_produk', 30);    // Console / Game / Aksesoris / Lainnya
            $table->string('tipe_model', 50);      // PS5, PS4, DualSense, dll
            $table->unsignedInteger('harga_sewa'); // rupiah per hari
            $table->unsignedInteger('stok_produk')->default(0);
            $table->string('status_produk', 20)->default('tersedia');
            $table->string('foto_produk')->nullable(); // path foto di storage/app/public
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};