<?php

namespace App\Filament\Clusters\Pages\Fields;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class Seo
{
    public static function getFields()
    {
        return Section::make('SEO')
            ->statePath('data.seo')
            ->columns(1)
            ->collapsed()
            ->schema([
                TextInput::make('seo_title')
                    ->formatStateUsing(fn ($state) => $state ?? Setting::getValueByKey('site_title'))
                    ->label('SEO Başlık'),

                Textarea::make('seo_description')
                    ->formatStateUsing(fn ($state) => $state ?? Setting::getValueByKey('seo_description'))
                    ->label('SEO Açıklama'),
            ]);
    }
}
