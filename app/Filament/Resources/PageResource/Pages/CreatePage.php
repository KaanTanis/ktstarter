<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Z3d0X\FilamentFabricator\Resources\PageResource\Pages\CreatePage as CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;
}
