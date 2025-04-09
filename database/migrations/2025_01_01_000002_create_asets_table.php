<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aset');
            $table->string('nama_aset');
            $table->foreignId('kategori_id')->constrained('kategori_asets')->onDelete('cascade');
            $table->string('lokasi')->nullable();
            $table->string('kondisi');
            $table->string('gambar_aset')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('asets');
    }
};
