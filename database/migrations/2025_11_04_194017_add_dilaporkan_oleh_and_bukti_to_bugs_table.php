<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('bugs', function (Blueprint $table) {
        $table->string('dilaporkan_oleh')->nullable()->after('judul');
    });
}
public function down()
{
    Schema::table('bugs', function (Blueprint $table) {
        $table->dropColumn('dilaporkan_oleh');
    });
}

};
