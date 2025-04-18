<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class TextBlock extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('text')
            ->label('Metin')
            ->schema([
                RichEditor::make('text')
                    ->label('Metin'),
            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}
