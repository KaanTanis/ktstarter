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
        'value' => 'json',
    ];

    public static function getValueByKey($key)
    {
        return optional(static::whereKey($key)->first())->value;
    }
}
