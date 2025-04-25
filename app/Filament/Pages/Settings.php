<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

/**
 * @property ComponentContainer $form
 */
class Settings extends Page implements HasForms
{
    use HasPageShield, InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    protected ?string $model = Setting::class;

    protected ?string $heading = 'Ayarlar';

    public ?array $data = [];

    public static function getNavigationLabel(): string
    {
        return __('Site Ayarları');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Ayarlar');
    }

    public function mount()
    {
        $this->form->fill(
            Setting::pluck('value', 'key')->toArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('tabs')
                    ->tabs([
                        Tab::make('Genel Ayarları')
                            ->schema([
                                Toggle::make('maintenance_mode')
                                    ->label('Bakım Modu'),
                                Textarea::make('maintenance_message')
                                    ->label('Bakım Modu Mesajı'),

                                Grid::make(3)
                                    ->schema([
                                        FileUpload::make('site_logo')
                                            ->label('Site Logosu')
                                            ->image()
                                            ->webp(),

                                        FileUpload::make('site_logo_dark')
                                            ->label('Site Logosu (Karanlık)')
                                            ->image()
                                            ->webp(),

                                        FileUpload::make('favicon')
                                            ->label('Favicon')
                                            ->image()
                                            ->webp(),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('email')
                                            ->label('İletişim E-Postası')
                                            ->email(),
                                        TextInput::make('phone')
                                            ->label('İletişim Telefonu')
                                            ->tel(),
                                        TextInput::make('address')
                                            ->label('İletişim Adresi'),
                                        TextInput::make('site_title')
                                            ->label('Site Başlığı'),
                                        TextInput::make('site_description')
                                            ->label('Site Açıklaması'),
                                        TextInput::make('copyright_text')
                                            ->label('Telif Hakkı Yazısı'),
                                    ]),
                            ]),

                        Tab::make('Çerez Bildirisi')
                            ->schema([
                                RichEditor::make('cookie_consent')
                                    ->label(__('Çerez Bildirisi'))
                                    ->columnSpan(2),
                            ]),

                        Tab::make('Redirection')
                            ->label(__('Yönlendirme Ayarları'))
                            ->schema([
                                Repeater::make('redirections')
                                    ->label('Yönlendirmeler')
                                    ->addActionLabel(__('Yönlendirme Ekle'))
                                    ->schema([
                                        Select::make('status_code')
                                            ->label(__('HTTP Durum Kodu'))
                                            ->options([
                                                '301' => '301 - Kalıcı Yönlendirme',
                                                '302' => '302 - Geçici Yönlendirme',
                                            ])
                                            ->columnSpan(2)
                                            ->required(),

                                        TextInput::make('old_url')
                                            ->label(__('Eski URL'))
                                            ->columnSpanFull()
                                            ->required(),

                                        TextInput::make('new_url')
                                            ->label(__('Yeni URL'))
                                            ->columnSpanFull()
                                            ->required(),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data')
            ->model($this->model);
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
        try {
            Cache::forget('redirections');

            $data = $this->form->getState();

            foreach ($data as $key => $value) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => $value,
                        'data_type' => gettype(is_array($value) ? head($value) : $value),
                    ]
                );
            }

            Notification::make()
                ->success()
                ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title(__('Hata !'))
                ->body($e->getMessage())
                ->send();
        }
    }
}
