<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGamepassIdToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // kolom string untuk menyimpan ID gamepass (bisa kosong / null)
            $table->string('gamepass_id')->nullable()->after('whatsapp');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('gamepass_id');
        });
    }
}
