<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Bug extends Model
{
    use HasFactory;

    // Field yang boleh diisi
    protected $fillable = [
        'judul',
        'dilaporkan_oleh',
        'prioritas',
        'deskripsi',
        'tanggal',
        'bukti',
    ];

    protected static function booted()
{
    static::deleting(function ($bug) {
        if ($bug->bukti && Storage::disk('public')->exists($bug->bukti)) {
            Storage::disk('public')->delete($bug->bukti);
        }
    });
}
}
