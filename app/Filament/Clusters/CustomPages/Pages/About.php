<?php

namespace App\Filament\Clusters\CustomPages\Pages;

use App\Filament\Clusters\CustomPages;
use App\Filament\Clusters\CustomPages\Fields\Seo;
use App\Models\Page as ModelsPage;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class About extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.custom-pages.pages.about';

    protected static ?string $cluster = CustomPages::class;

    protected static ?string $navigationLabel = 'Hakkımızda';

    protected ?string $heading = 'Hakkımızda';

    public ?array $data = [];

    protected $pageType = 'about';

    public function mount()
    {
        $this->form->fill(
            ModelsPage::where('type', $this->pageType)->first()->toArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Seo::getFields(),

            RichEditor::make('data.content')
                ->label('İçerik'),
        ]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $page = ModelsPage::where('type', $this->pageType)->first();

        $page->update($data);

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}