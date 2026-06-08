<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel customers
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            // Relasi ke tabel iphones
            $table->foreignId('iphone_id')->constrained('iphones')->cascadeOnDelete();

            $table->date('tgl_sewa');
            $table->date('tgl_kembali');
            $table->integer('total_hari'); // Berapa hari disewa
            $table->integer('total_harga'); // total_hari * harga_perhari
            $table->enum('status_booking', ['Aktif', 'Selesai', 'Batal'])->default('Aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
