<?php

namespace App\Services\Seo;

use App\Models\Setting;
use App\Models\Work;
use Artesaos\SEOTools\Contracts\SEOFriendly;
use Artesaos\SEOTools\Contracts\SEOTools;
use Illuminate\Support\Facades\Storage;

class WorkSEO implements SEOFriendly
{
    public function __construct(public Work $post) {}

    public function loadSEO(SEOTools $seoTools)
    {
        $sperator = Setting::getValueByKey('site_title_sperator');
        $seoTitle = Setting::getValueByKey('seo_title');
        $seoDescription = Setting::getValueByKey('seo_description');
        $seoEnd = " {$sperator} {$seoTitle}";

        $description = $this->post->seo_description ?? $seoDescription;
        $title = ($this->post->seo_title ?? strip_tags($this->post->title)).$seoEnd;

        // Genel Meta Etiketler
        $seoTools->setTitle($title)
            ->setDescription($description)
            ->setCanonical($this->post->url);

        $imageUrl = Storage::disk('public')->url($this->post->cover);

        if ($imageUrl) {
            $seoTools->addImages($imageUrl);
        }

        // OpenGraph Ayarları
        $seoTools->opengraph()->addProperty('locale', app()->getLocale())
            ->addProperty('type', 'WebPage')
            ->addProperty('site_name', 'Kaan Tanış')
            ->addProperty('description', $description)
            ->addProperty('title', $title)
            ->addProperty('application-name', 'Kaan Tanış')
            ->addProperty('url', $this->post->url);

        // Twitter Card Ayarları
        $seoTools->twitter()->addValue('card', 'summary_large_image')
            ->addValue('site', '@kaantns')
            ->addValue('creator', '@kaantns')
            ->addValue('description', $description);

        // JSON-LD Yapılandırılmış Veri
        $jsonLd = $seoTools->jsonLdMulti();
        $jsonLd->setType('WebPage');
        $jsonLd->addValues([
            '@id' => $this->post->url,
            'url' => $this->post->url,
            'name' => $title,
            'headline' => $title,
            'description' => $description,
            'sameAs' => [
                'https://www.instagram.com/kaan.tns',
                'https://www.linkedin.com/in/kaan-tanış-4a317a250/',
                'https://twitter.com/kaantns',
            ],
            'isPartOf' => [
                '@id' => url('/').'/#website',
            ],
            'publisher' => [
                '@id' => url('/').'/#organization',
                '@type' => 'Organization',
                'name' => 'Kaan Tanış',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => url('/logo.svg'),
                    'width' => 300,
                    'height' => 300,
                ],
            ],
            'author' => [
                '@id' => url('/').'/#person',
                '@type' => 'Person',
                'name' => 'Kaan Tanış',
                'url' => url('/').'/#person',
            ],
            'datePublished' => $this->post->published_at->toIso8601String(),
            'dateModified' => $this->post->updated_at->toIso8601String(),
            'mainEntityOfPage' => [
                '@id' => $this->post->url,
                '@type' => 'WebPage',
            ],
            'articleSection' => $this->post->type ?? 'Uncategorized',
            'image' => [
                '@type' => 'ImageObject',
                'url' => $imageUrl,
                'height' => 800,
                'width' => 1200,
            ],
        ]);

        $jsonLd->addValue('breadcrumb', [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => trans('Ana Sayfa'),
                    'item' => url('/'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => trans('Projeler'),
                    'item' => route('works'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $title,
                    'item' => $this->post->url,
                ],
            ],
        ]);
    }
}
