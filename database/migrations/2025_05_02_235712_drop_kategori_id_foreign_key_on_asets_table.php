<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']); // Drop FK lama
        });
    }

    public function down(): void
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategori_asets')
                ->onDelete('cascade');
        });
    }
};
