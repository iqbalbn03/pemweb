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
        Schema::create('privasi', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('pelanggan_id'); // Foreign key ke pelanggans.id
            $table->dateTime('waktu_beli');  // Tanggal mulai langganan Privasi
            $table->dateTime('waktu_habis'); // Tanggal habis langganan Privasi
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pelanggan_id')
                ->references('id')->on('pelanggans')
                ->onDelete('cascade'); // Jika pelanggan dihapus, data privasinya juga ikut dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privasis');
    }
};
