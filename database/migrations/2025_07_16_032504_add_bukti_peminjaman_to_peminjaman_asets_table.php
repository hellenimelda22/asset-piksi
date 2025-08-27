<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('peminjaman_asets', function (Blueprint $table) {
            $table->string('bukti_peminjaman')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman_asets', function (Blueprint $table) {
            $table->dropColumn('bukti_peminjaman');
        });
    }
};
