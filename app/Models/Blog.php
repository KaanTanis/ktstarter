<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model implements Viewable
{
    use HasFactory;
    use HasSlug;
    use InteractsWithViews;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $removeViewsOnDelete = true;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function summary($limit = 200)
    {
        // remove html tags
        $string = strip_tags($this->content);

        // truncate string
        $stringCut = substr($string, 0, $limit);

        // make sure it ends in a word so assassinate doesn
        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';

        return $string;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getUrlAttribute()
    {
        return route('blog', $this->slug);
    }

    public function scopePublished()
    {
        return $this->where('published_at', '<=', now());
    }

    public function scopeOrderByPublished()
    {
        return $this->orderBy('published_at', 'desc');
    }
}
