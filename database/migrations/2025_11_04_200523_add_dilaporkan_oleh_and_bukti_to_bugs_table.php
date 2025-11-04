<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bugs', function (Blueprint $table) {
            // Tambah kolom dilaporkan_oleh dan bukti
            if (!Schema::hasColumn('bugs', 'dilaporkan_oleh')) {
                $table->string('dilaporkan_oleh')->nullable()->after('judul');
            }

            if (!Schema::hasColumn('bugs', 'bukti')) {
                $table->string('bukti')->nullable()->after('tanggal');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bugs', function (Blueprint $table) {
            if (Schema::hasColumn('bugs', 'dilaporkan_oleh')) {
                $table->dropColumn('dilaporkan_oleh');
            }

            if (Schema::hasColumn('bugs', 'bukti')) {
                $table->dropColumn('bukti');
            }
        });
    }
};
