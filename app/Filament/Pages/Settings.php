<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Cache;

/**
 * @property Schema $form
 */
class Settings extends Page implements HasForms
{
    use HasPageShield, InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.settings';

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

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('tabs')
                    ->tabs([
                        Tab::make('Genel Ayarları')
                            ->schema([
                                Toggle::make('maintenance_mode')
                                    ->label('Bakım Modu'),
                                Textarea::make('maintenance_message')
                                    ->label('Bakım Modu Mesajı'),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('contact_mail')
                                            ->columnSpan(2)
                                            ->label('Mail Birincil İletişim E-Postası')
                                            ->email(),
                                        Repeater::make('contact_mail_cc')
                                            ->label('Mail CC İletişim E-Postaları')
                                            ->addActionLabel('E-Posta Ekle')
                                            ->columnSpan(2)
                                            ->schema([
                                                TextInput::make('email')
                                                    ->label('E-Posta Adresi')
                                                    ->email(),
                                            ]),

                                        TextInput::make('email')
                                            ->label('E-Posta')
                                            ->email(),
                                        TextInput::make('phone')
                                            ->label('Telefon')
                                            ->tel(),
                                        TextInput::make('address')
                                            ->label('Adres'),
                                        TextInput::make('site_title')
                                            ->helperText('Eğer görüntülenen içerik SEO ayarı boş ise, site başlığı kullanılacaktır.')
                                            ->label('Site Başlığı'),
                                        Textarea::make('site_description')
                                            ->columnSpan(2)
                                            ->helperText('Eğer görüntülenen içerik SEO ayarı boş ise, site açıklaması kullanılacaktır.')
                                            ->label('Site Açıklaması'),
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
        } catch (Exception $e) {
            Notification::make()
                ->danger()
                ->title(__('Hata !'))
                ->body($e->getMessage())
                ->send();
        }
    }
}
