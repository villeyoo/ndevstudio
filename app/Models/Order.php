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
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
