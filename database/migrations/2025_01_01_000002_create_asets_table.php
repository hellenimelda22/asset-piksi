<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aset')->unique(); // LTP-001, LTP-002
            $table->string('nama_aset'); // Laptop Dell 3420
            $table->enum('status', ['Tersedia', 'Dipinjam', 'Rusak'])->default('Tersedia');
            $table->enum('kondisi', ['Baik', 'Rusak'])->default('Baik');
            $table->unsignedBigInteger('kategori_id');
            $table->string('lokasi')->nullable();
            $table->string('gambar_aset')->nullable();
            $table->timestamps();
        
            $table->foreign('kategori_id')->references('id')->on('kategori_aset')->onDelete('cascade');
        });
    }        

    public function down(): void {
        Schema::dropIfExists('asets');
    }
};
