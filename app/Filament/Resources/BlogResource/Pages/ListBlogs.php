<?php

namespace App\Filament\Resources\BlogResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogs extends ListRecords
{
    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
