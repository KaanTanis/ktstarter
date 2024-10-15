<?php

namespace App\Filament\Clusters\CustomPages\Pages;

use App\Filament\Clusters\CustomPages;
use App\Filament\Clusters\CustomPages\Fields\Seo;
use App\Traits\CustomPageTrait;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Home extends Page
{
    use CustomPageTrait, InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.clusters.custom-pages.pages.default';

    protected static ?string $cluster = CustomPages::class;

    protected static ?string $navigationLabel = 'Ana Sayfa';

    protected ?string $heading = 'Ana Sayfa';

    protected $pageType = 'home';

    public function form(Form $form): Form
    {
        return $form->schema([
            Seo::getFields(),
        ]);
    }
}
