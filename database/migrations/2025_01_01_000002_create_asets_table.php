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
            $table->unsignedBigInteger('kategori_id');
            $table->string('lokasi');
            $table->string('kondisi');
            $table->string('gambar_aset')->nullable();
            $table->string('status');
            $table->timestamps();
    
            // Foreign key
            $table->foreign('kategori_id')->references('id')->on('kategori_asets')->onDelete('cascade');
        });
        
    }        

    public function down(): void {
        Schema::dropIfExists('asets');
    }
};
