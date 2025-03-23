<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use Z3d0X\FilamentFabricator\Resources\PageResource\Pages\EditPage as EditRecord;

class EditPage extends EditRecord
{
    use Translatable;

    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            // TranslateAndCopyAction::make(),
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make()
                ->visible(config('filament-fabricator.enable-view-page')),
            Actions\Action::make('save')
                ->action('save')
                ->label('Kaydet'),
            Actions\DeleteAction::make(),
        ];
    }
}
