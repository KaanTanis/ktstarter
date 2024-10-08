<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

class Work extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;
    use SortableTrait;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'published_at' => 'datetime',
        'code_field' => 'array',
        'properties' => 'array',
        'order_column' => 'integer',
    ];

    public function getUrlAttribute()
    {
        return route('work', $this->slug);
    }
}
