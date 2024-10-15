<?php

namespace App\Filament\Clusters\CustomPages\Pages;

use App\Filament\Clusters\CustomPages;
use App\Filament\Clusters\CustomPages\Fields\Seo;
use App\Traits\CustomPageTrait;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Blogs extends Page
{
    use CustomPageTrait, InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    protected static string $view = 'filament.clusters.custom-pages.pages.default';

    protected static ?string $cluster = CustomPages::class;

    protected static ?string $navigationLabel = 'Bloglar';

    protected ?string $heading = 'Bloglar';

    protected $pageType = 'blogs';

    public function form(Form $form): Form
    {
        return $form->schema([
            Seo::getFields(),
        ]);
    }
}
