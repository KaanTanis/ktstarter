<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'services',
        'budget',
        'message',
        'status',
        'ip_address',
        'user_agent',
        'referrer',
    ];

    protected $casts = [
        'services' => 'array',
    ];
}
