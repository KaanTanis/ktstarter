<?php

namespace App\Filament\Resources\PageResource\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\PageResource;
use Filament\Actions;
use Z3d0X\FilamentFabricator\Resources\PageResource\Pages\EditPage as EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            ViewAction::make()
                ->visible(config('filament-fabricator.enable-view-page')),
            Action::make('save')
                ->action('save')
                ->label('Kaydet'),
            DeleteAction::make(),
        ];
    }
}
