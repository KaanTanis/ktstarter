<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Blade;
use App\Models\Traits\HasSitemapAttributes;
use Spatie\MediaLibrary\InteractsWithMedia;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Z3d0X\FilamentFabricator\Models\Page as BasePage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;

/**
 * @property string $url
 */
class Page extends BasePage implements Viewable, HasMedia
{
    use HasSitemapAttributes;
    use HasSlug;
    use InteractsWithViews;
    use InteractsWithMedia;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

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

    public function render(): string
    {
        $component = FilamentFabricator::getLayoutFromName($this->layout)::getComponent();

        return Blade::render(
            <<<'BLADE'
                <x-dynamic-component
                    :$component
                    :$page
                />
            BLADE,
            ['component' => $component, 'page' => $this]
        );
    }

    public function getSlugOptions(): SlugOptions
    {
        if ($this->slug === '/') {
            return SlugOptions::create()
                ->generateSlugsFrom('title')
                ->saveSlugsTo('slug')
                ->doNotGenerateSlugsOnUpdate();
        }

        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getUrlAttribute(): false|string
    {
        if (! $this->slug) {
            return false;
        }

        if ($this->slug === '/') {
            return url('/');
        }

        return route('page', [
            'filamentFabricatorPage' => $this->slug,
        ]);
    }

    public static function findBySlug(string $slug)
    {
        return static::slug($slug)->firstOrFail();
    }

    public function getTitleColumn(): string
    {
        return 'title';
    }

    public function getMenuLabel(): string
    {
        return 'Sayfalar';
    }

    public function getMenuUrl(): string
    {
        return $this->url;
    }
}
