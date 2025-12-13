<?php

namespace App\Models;

use App\Models\Traits\HasSitemapAttributes;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements Viewable, HasMedia
{
    use HasFactory;
    use HasSitemapAttributes;
    use HasSlug;
    use InteractsWithViews;
    use InteractsWithMedia;

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

    public function summary($limit = 200)
    {
        $string = strip_tags($this->content);

        $stringCut = substr($string, 0, $limit);

        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';

        return $string;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function getUrlAttribute()
    {
        return route('posts.show', $this);
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
