<?php

namespace App\Traits;

use App\Models\Page as ModelsPage;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

trait CustomPageTrait
{
    public ?array $data = [];

    public function mount()
    {
        $this->form->fill(
            ModelsPage::where('type', $this->getPageType())->first()->toArray()
        );
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

        $page = ModelsPage::where('type', $this->getPageType())->first();

        $page->update($data);

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }

    protected function getPageType(): string
    {
        return $this->pageType;
    }
}
