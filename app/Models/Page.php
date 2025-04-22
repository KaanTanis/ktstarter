<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Support\Facades\Blade;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;
use Z3d0X\FilamentFabricator\Models\Page as BasePage;

/**
 * @property string $url
 */
class Page extends BasePage implements Viewable
{
    use HasSlug;
    use HasTranslations;
    use InteractsWithViews;

    public $translatable = ['title', 'slug', 'blocks', 'seo_title', 'seo_description'];

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

    protected function handleForcePublished($query, bool $forcePublished = true): void
    {
        if (($forcePublished && ! request()->boolean('preview')) || ! auth('admin')->check()) {
            $query->published();
        }
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getUrlAttribute(): false|string
    {
        return $this->slug
            ? route('page', [
                'filamentFabricatorPage' => $this->slug,
            ])
            : false;
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

    public function exceptedTranslationStatusAttributes(): array
    {
        return [
            'seo',
            'breadcrumb',
        ];
    }
}
