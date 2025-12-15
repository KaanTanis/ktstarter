<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class TextBlock extends PageBlock
{
    protected static string $name = 'text';

    public static function defineBlock(Block $block): Block
    {
        return Block::make('text')
            ->label('Metin')
            ->schema([
                TextInput::make('text')
                    ->label('Metin')
                    ->required(),
            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}
