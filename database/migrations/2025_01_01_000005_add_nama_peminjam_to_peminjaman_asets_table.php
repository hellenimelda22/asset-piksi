<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('peminjaman_asets', function (Blueprint $table) {
            $table->string('nama_peminjam')->after('user_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('peminjaman_asets', function (Blueprint $table) {
            $table->dropColumn('nama_peminjam');
        });
    }    
};
