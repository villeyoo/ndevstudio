<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CustomUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'custom_users'; // sesuaikan kalau berbeda

    protected $fillable = [
        'username',
        'password',
        'role',      // tambahkan agar mudah mass assignment saat seed/tinker
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
