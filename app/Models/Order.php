<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'username',
        'whatsapp',
        'payment_method',
        'status',
        'gamepass_id', // pastikan ada
    ];

    /**
     * Relasi ke product
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    
}
