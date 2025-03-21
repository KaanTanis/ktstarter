<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Spatie\Sluggable\SlugOptions;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;
use Z3d0X\FilamentFabricator\Models\Page as BasePage;

/**
 * @property string $url
 */
class Page extends BasePage implements Viewable
{
    use InteractsWithViews;

    public $translatable = ['title', 'slug', 'blocks', 'breadcrumb', 'seo'];

    protected $casts = ['published_at' => 'datetime'];

    protected static function booted()
    {
        // Don't override parent::booted() because it blocks the logging on delete
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation  $query
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function resolveRouteBindingQuery($query, $value, $field = null)
    {
        $isFilamentRequest = $this->isFilamentRequest();

        return $isFilamentRequest
            ? parent::resolveRouteBindingQuery($query, $value, $field)
            : $query->slug($value); // @phpstan-ignore-line
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

    public function scopePublished(Builder $builder): Builder
    {
        return $builder->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    protected function handleForcePublished($query, bool $forcePublished = true): void
    {
        if (($forcePublished && ! request()->boolean('preview')) || ! auth('admin')->check()) {
            $query->published();
        }
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(config('translatable.locales'))
            ->preventOverwrite()
            ->skipGenerateWhen(fn () => $this->slug === '/' || \Illuminate\Support\Str::contains($this->slug, '/'))
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getUrlAttribute(): false|string
    {
        return getLocalizedUrl(url: $this->slug);
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