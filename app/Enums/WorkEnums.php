<?php

namespace App\Enums;

enum WorkEnums: string
{
    case TYPE_WEB_DESIGN = 'web_design';
    case TYPE_WEB_DEVELOPMENT = 'web_development';
    case TYPE_MOBILE_DEVELOPMENT = 'mobile_development';
    case TYPE_GRAPHIC_DESIGN = 'graphic_design';
    case TYPE_SEO = 'seo';

    /**
     * @return array<string, string>
     */
    public static function toSelectOptions(): array
    {
        return [
            self::TYPE_WEB_DESIGN->value => 'Web Tasarım',
            self::TYPE_WEB_DEVELOPMENT->value => 'Web Geliştirme',
            self::TYPE_MOBILE_DEVELOPMENT->value => 'Mobil Geliştirme',
            self::TYPE_GRAPHIC_DESIGN->value => 'Grafik Tasarım',
            self::TYPE_SEO->value => 'SEO',
        ];
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::TYPE_WEB_DESIGN => 'Web Tasarım',
            self::TYPE_WEB_DEVELOPMENT => 'Web Geliştirme',
            self::TYPE_MOBILE_DEVELOPMENT => 'Mobil Geliştirme',
            self::TYPE_GRAPHIC_DESIGN => 'Grafik Tasarım',
            self::TYPE_SEO => 'SEO',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::TYPE_WEB_DESIGN => 'heroicon-o-globe-alt',
            self::TYPE_WEB_DEVELOPMENT => 'heroicon-o-command-line',
            self::TYPE_MOBILE_DEVELOPMENT => 'heroicon-o-device-phone-mobile',
            self::TYPE_GRAPHIC_DESIGN => 'heroicon-o-pencil',
            self::TYPE_SEO => 'heroicon-o-chart-pie',
        };
    }
}
