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
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia, Viewable
{
    use HasFactory;
    use HasSitemapAttributes;
    use HasSlug;
    use InteractsWithMedia;
    use InteractsWithViews;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $with = ['media'];

    protected $removeViewsOnDelete = true;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('responsive')
            ->withResponsiveImages()
            ->format('webp')
            ->quality(80)
            ->nonQueued();
    }

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
