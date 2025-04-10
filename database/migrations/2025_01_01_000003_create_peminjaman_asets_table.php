<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('peminjaman_asets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')->constrained('asets')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->string('status')->default('Dipinjam');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('peminjaman_asets');
    }
};
