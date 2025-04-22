<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Actions\GeneratePasswordAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Ayarlar';

    protected static ?string $modelLabel = 'Kullanıcı';

    protected static ?string $pluralModelLabel = 'Kullanıcılar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('İsim')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('E-posta')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('password')
                    ->label('Parola')
                    ->password()
                    ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser)
                    ->maxLength(255)
                    ->dehydrated(fn ($state) => filled($state))
                    ->confirmed()
                    ->suffixAction(GeneratePasswordAction::make())
                    ->minLength(8)
                    ->revealable()
                    ->afterStateHydrated(fn ($component) => $component->state(null))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->autocomplete(false),
                Forms\Components\TextInput::make('password_confirmation')
                    ->label('Parola Tekrar')
                    ->password()
                    ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser)
                    ->maxLength(255)
                    ->password()
                    ->minLength(8)
                    ->revealable()
                    ->dehydrated(false)
                    ->autocomplete(false),

                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->label('Rol')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->searchable(),

            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('email', '!=', 'kt@kaantanis.com');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('İsim'),

                TextColumn::make('email')
                    ->label('E-posta'),

                TextColumn::make('roles.name')
                    ->label('Rol')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
