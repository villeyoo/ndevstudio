<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kasus_bukti', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->string('file_path'); // foto / video
            $table->string('pelapor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus_bukti');
    }
};
