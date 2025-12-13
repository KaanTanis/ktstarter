<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Models\Post;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|\BackedEnum|null $navigationIcon = null;

    protected static ?string $modelLabel = 'Post';

    protected static ?string $pluralModelLabel = 'Postlar';

    protected static string|\UnitEnum|null $navigationGroup = 'CMS';

    protected static bool $shouldRegisterNavigation = true;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
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
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Kategori Adı')
                                    ->required(),
                            ]),

                        RichEditor::make('content')
                            ->label('İçerik')
                            ->required(),
                    ]),

                Section::make('SEO & Görsel')
                    ->columnSpan(1)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Kapak Fotoğrafı')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->collection('cover')
                            ->responsiveImages()
                            ->imageEditorAspectRatios([
                                null,
                                '4:3',
                            ]),

                        SpatieMediaLibraryFileUpload::make('banner')
                            ->label('Banner Fotoğrafı')
                            ->image()
                            ->imageEditor()
                            ->collection('banner')
                            ->responsiveImages()
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
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
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
