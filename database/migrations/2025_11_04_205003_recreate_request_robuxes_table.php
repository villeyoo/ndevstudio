<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus tabel lama jika ada, lalu buat ulang (clean)
        Schema::dropIfExists('request_robuxes');

        Schema::create('request_robuxes', function (Blueprint $table) {
            $table->id();
            $table->string('username');       // username Roblox
            $table->string('requested_by');   // siapa yang request (staff)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_robuxes');
    }
};
