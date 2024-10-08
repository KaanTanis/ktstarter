<?php

namespace App\Filament\Clusters\Pages\Pages;

use App\Filament\Clusters\Pages;
use App\Filament\Clusters\Pages\Fields\Seo;
use App\Models\Page as ModelsPage;
use Filament\Actions\Action;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

/**
 * @property ComponentContainer $form
 */
class Home extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.pages.pages.home';

    protected static ?string $cluster = Pages::class;

    protected ?string $model = ModelsPage::class;

    protected static ?string $navigationLabel = 'Ana Sayfa';

    public ?array $data = [];

    protected $pageType = 'home';

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

            Section::make('Hero')
                ->statePath('data.hero')
                ->columns(2)
                ->collapsible()
                ->schema([
                    TextInput::make('title')
                        ->label('Başlık'),
                ]),
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
