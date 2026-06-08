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
        Schema::create('iphones', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('tipe_iphone');
            $table->integer('kapasitas');
            $table->string('warna');
            $table->integer('harga_perhari');
            $table->enum('status', ['Tersedia', 'Disewa', 'Maintenance'])->default('Tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iphones');
    }
};
