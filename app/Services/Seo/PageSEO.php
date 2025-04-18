<?php

namespace App\Services\Seo;

use App\Models\Page;
use App\Models\Setting;
use Artesaos\SEOTools\Contracts\SEOFriendly;
use Artesaos\SEOTools\Contracts\SEOTools;

class PageSEO implements SEOFriendly
{
    public function __construct(public Page $page) {}

    public function loadSEO(SEOTools $seoTools)
    {
        $title = data_get($this->page, 'seo_title')
            ?? Setting::getValueByKey('title');

        $description = data_get($this->page, 'seo_description')
            ?? null;

        // Genel Meta Etiketler
        $seoTools->setTitle($title)
            ->setDescription($description)
            ->setCanonical(url('/'));

        $imageUrl = asset('logo.png');

        if ($imageUrl) {
            $seoTools->addImages($imageUrl);
        }

        // OpenGraph Ayarları
        $seoTools->opengraph()->addProperty('locale', app()->getLocale())
            ->addProperty('type', 'website')
            ->addProperty('site_name', config('app.name'))
            ->addProperty('description', $description)
            ->addProperty('title', $title)
            ->addProperty('application-name', config('app.name'))
            ->addProperty('url', url('/'));

        // JSON-LD Yapılandırılmış Veri
        $jsonLd = $seoTools->jsonLdMulti();
        $jsonLd->setType('WebSite');
        $jsonLd->addValues([
            '@id' => url('/'),
            'url' => url('/'),
            'name' => $title,
            'headline' => $title,
            'description' => $description,
            'isPartOf' => [
                '@id' => url('/').'/#website',
            ],
            'publisher' => [
                '@id' => url('/').'/#organization',
                '@type' => 'Organization',
                'name' => config('app.name'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => url('/logo.png'),
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
    }
}
