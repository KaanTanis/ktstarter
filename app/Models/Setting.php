<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $casts = [
        'value' => 'string',
    ];

    public static function getValueByKey($key)
    {
        return static::whereKey($key)->first()->value ?? null;
    }
}
