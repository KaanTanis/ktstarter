<?php

namespace App\Services\Seo;

use App\Models\Page;
use App\Models\Setting;
use Artesaos\SEOTools\Contracts\SEOFriendly;
use Artesaos\SEOTools\Contracts\SEOTools;

class WorksSEO implements SEOFriendly
{
    public function __construct(public Page $page) {}

    public function loadSEO(SEOTools $seoTools)
    {
        $title = data_get($this->page, 'data.seo.seo_title')
            ?? Setting::getValueByKey('site_title')
            ?? Setting::getValueByKey('seo_title');
        $description = data_get($this->page, 'data.seo.seo_description')
            ?? Setting::getValueByKey('seo_description');

        // Genel Meta Etiketler
        $seoTools->setTitle($title)
            ->setDescription($description)
            ->setCanonical(route('works'));

        $imageUrl = asset('logo.svg');

        if ($imageUrl) {
            $seoTools->addImages($imageUrl);
        }

        // OpenGraph Ayarları
        $seoTools->opengraph()->addProperty('locale', app()->getLocale())
            ->addProperty('type', 'website')
            ->addProperty('site_name', 'Kaan Tanış')
            ->addProperty('description', $description)
            ->addProperty('title', $title)
            ->addProperty('application-name', 'Kaan Tanış')
            ->addProperty('url', url('/'));

        // Twitter Card Ayarları
        $seoTools->twitter()->addValue('card', 'summary_large_image')
            ->addValue('site', '@kaantns')
            ->addValue('creator', '@kaantns')
            ->addValue('description', $description);

        // JSON-LD Yapılandırılmış Veri
        $jsonLd = $seoTools->jsonLdMulti();
        $jsonLd->setType('WebPage');
        $jsonLd->addValues([
            '@id' => url('/'),
            'url' => url('/'),
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
            'mainEntityOfPage' => [
                '@id' => url('/'),
                '@type' => 'WebPage',
            ],
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
            ],
        ]);
    }
}
