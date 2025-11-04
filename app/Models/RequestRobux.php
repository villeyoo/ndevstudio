<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestRobux extends Model
{
    protected $table = 'request_robuxes';

    protected $fillable = [
        'username',
        'requested_by',
        'status',
        'notes',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];
}
