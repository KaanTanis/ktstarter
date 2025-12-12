<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class GeneratePasswordAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'generatePassword';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-key')
            ->color('info')
            ->tooltip(__('Generate Password'))
            ->action(function (Set $set) {
                $password = Str::password(10);

                $set('password', $password);
                $set('password_confirmation', $password);

                Notification::make()
                    ->success()
                    ->title(__('Password Generated'))
                    ->send();
            });
    }
}
