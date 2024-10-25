<?php

namespace App\Filament\Clusters\CustomPages\Pages;

use App\Filament\Clusters\CustomPages;
use App\Filament\Clusters\CustomPages\Fields\Seo;
use App\Traits\CustomPageTrait;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class About extends Page
{
    use CustomPageTrait, InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static string $view = 'filament.clusters.custom-pages.pages.default';

    protected static ?string $cluster = CustomPages::class;

    protected static ?string $navigationLabel = 'Hakkımızda';

    protected ?string $heading = 'Hakkımızda';

    protected $pageType = 'about';

    public function form(Form $form): Form
    {
        return $form->schema([
            Seo::getFields(),

            RichEditor::make('data.content')
                ->label('İçerik'),
        ]);
    }
}
