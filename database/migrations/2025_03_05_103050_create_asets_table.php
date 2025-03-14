<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aset');
            $table->string('nama_aset');
            $table->unsignedBigInteger('kategori_id'); // Harus Unsigned
            $table->string('lokasi');
            $table->enum('kondisi', ['Baik', 'Rusak']);
            $table->string('gambar_aset')->nullable();
            $table->enum('status', ['Tersedia', 'Dipinjam'])->default('Tersedia');
            $table->timestamps();

            // $table->foreign('kategori_id')->references('id')->on('kategori_asets')->onDelete('cascade'); // Dikomentari
        });
    }

    public function down()
    {
        Schema::dropIfExists('asets');
    }
};
