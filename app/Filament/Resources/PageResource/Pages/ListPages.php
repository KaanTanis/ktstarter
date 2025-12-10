<?php

namespace App\Filament\Resources\PageResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\PageResource;
use Filament\Actions;
use Z3d0X\FilamentFabricator\Resources\PageResource\Pages\ListPages as ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
