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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('id_booking');
            $table->string('id_pelanggan');
            $table->string('unit');
            $table->string('tanggal_booking');
            $table->string('tanggal_mulai');
            $table->string('tanggal_selesai');
            $table->string('nama_unit');
            $table->string('jumlah_unit');
            $table->string('total_biaya');
            $table->string('status_booking');
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
