<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusBukti extends Model
{
    use HasFactory;

    protected $table = 'kasus_bukti';

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'file_path',
        'pelapor'
    ];
}
