<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('asets', function (Blueprint $table) {
        $table->integer('stok')->default(0);
    });
}

public function down()
{
    Schema::table('asets', function (Blueprint $table) {
        $table->dropColumn('stok');
    });
}
};
