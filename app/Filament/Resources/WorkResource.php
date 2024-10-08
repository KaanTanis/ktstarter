<?php

namespace App\Filament\Resources;

use App\Enums\WorkEnums;
use App\Filament\Resources\WorkResource\Pages;
use App\Models\Work;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class WorkResource extends Resource
{
    protected static ?string $model = Work::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'İşler';

    protected static ?string $pluralModelLabel = 'İşler';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Tabs::make('İçerik')
                            ->columnSpan(2)
                            ->tabs([
                                Tab::make('Genel')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Başlık')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                                    return;
                                                }

                                                $set('slug', Str::slug($state));
                                            })
                                            ->required(),

                                        TextInput::make('slug')
                                            ->label('URL')
                                            ->required(),

                                        Textarea::make('summary')
                                            ->label('Özet')
                                            ->required(),

                                        Select::make('type')
                                            ->options(WorkEnums::toSelectOptions())
                                            ->label('Tür')
                                            ->required(),
                                    ]),

                                Tab::make('Görseller')
                                    ->schema([
                                        FileUpload::make('cover')
                                            ->label('Kapak')
                                            ->webp(),

                                        FileUpload::make('desktop_mockup')
                                            ->label('Masaüstü Mockup')
                                            ->webp(),

                                        FileUpload::make('mobile_mockup')
                                            ->label('Mobil Mockup')
                                            ->webp(),
                                    ]),

                                Tab::make('İçerik')
                                    ->schema([
                                        TextInput::make('web_url')
                                            ->label('URL'),

                                        RichEditor::make('body')
                                            ->label('İçerik'),

                                        Repeater::make('code_field')
                                            ->label('Kod Alanı')
                                            ->schema([
                                                TextInput::make('prefix')
                                                    ->label('Prefix'),

                                                Select::make('color_class')
                                                    ->options([
                                                        'text-warning' => 'Sarı',
                                                        'text-success' => 'Yeşil',
                                                        'text-danger' => 'Kırmızı',
                                                        'text-primary' => 'Mavi',
                                                    ])
                                                    ->label('Renk'),

                                                TextInput::make('code')
                                                    ->label('Kod'),
                                            ]),

                                        Repeater::make('properties')
                                            ->label('Özellikler')
                                            ->schema([
                                                TextInput::make('key')
                                                    ->label('Anahtar'),

                                                TextInput::make('value')
                                                    ->label('Değer'),
                                            ]),
                                    ]),
                            ]),

                        Section::make()
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('seo_title')
                                    ->label('SEO Başlık'),

                                Textarea::make('seo_description')
                                    ->label('SEO Açıklama'),

                                DateTimePicker::make('published_at')
                                    ->label('Yayın Tarihi')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Başlık')
                    ->sortable()
                    ->html()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Tür')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => WorkEnums::from($state)->getLabel())
                    ->icon(fn ($state) => WorkEnums::from($state)->getIcon())
                    ->searchable(),
            ])->reorderable('order_column')->defaultSort('order_column')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorks::route('/'),
            'create' => Pages\CreateWork::route('/create'),
            'edit' => Pages\EditWork::route('/{record}/edit'),
        ];
    }
}
