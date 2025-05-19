<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTahunPerolehanToAsetsTable extends Migration
{
    public function up()
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->year('tahun_perolehan')->nullable(); // Menambahkan kolom tahun_perolehan
        });
    }

    public function down()
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->dropColumn('tahun_perolehan');
        });
    }
}
