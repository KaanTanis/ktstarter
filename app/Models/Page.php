<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'meta' => 'array',
    ];
}
