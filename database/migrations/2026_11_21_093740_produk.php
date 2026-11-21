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
            $table->string('id_produk');
            $table->string('nama_produk');
            $table->string('jenis_produk');
            $table->string('tipe_model');
            $table->string('harga_sewa');
            $table->string('stok_produk');
            $table->string('status_produk');
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
