<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = null;

    protected static ?string $modelLabel = 'Blog';

    protected static ?string $pluralModelLabel = 'Bloglar';

    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Section::make('İçerik')
                            ->columnSpan(2)
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

                                Select::make('tags')
                                    ->label('Etiketler')
                                    ->relationship(titleAttribute: 'name')
                                    ->multiple()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Kategori Adı')
                                            ->required(),
                                    ]),

                                TinyEditor::make('content')
                                    ->label('İçerik')
                                    ->required(),
                            ]),

                        Section::make('SEO & Görsel')
                            ->columnSpan(1)
                            ->schema([
                                FileUpload::make('cover')
                                    ->label('Kapak Fotoğrafı')
                                    ->image()
                                    ->imageEditor()
                                    ->required()
                                    ->imageEditorAspectRatios([
                                        null,
                                        '4:3',
                                    ]),

                                FileUpload::make('banner')
                                    ->label('Banner Fotoğrafı')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        null,
                                        '5:1',
                                    ]),

                                TextInput::make('seo_title')
                                    ->label('SEO Başlık'),

                                Textarea::make('seo_description')
                                    ->label('SEO Açıklama'),

                                DateTimePicker::make('published_at')
                                    ->label('Yayın Tarihi')
                                    ->default(now()),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Kapak'),

                TextColumn::make('title')
                    ->searchable()
                    ->label('Başlık'),

                TextColumn::make('views_count')
                    ->sortable()
                    ->label('Görüntülenme'),
            ])
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
