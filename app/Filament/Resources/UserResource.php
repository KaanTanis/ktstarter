<?php

namespace App\Filament\Resources;

use App\Filament\Actions\GeneratePasswordAction;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static string|\UnitEnum|null $navigationGroup = 'Ayarlar';

    protected static ?string $modelLabel = 'Kullanıcı';

    protected static ?string $pluralModelLabel = 'Kullanıcılar';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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

                TextInput::make('password')
                    ->label('Parola')
                    ->password()
                    ->required(fn ($livewire) => $livewire instanceof CreateUser)
                    ->maxLength(255)
                    ->dehydrated(fn ($state) => filled($state))
                    ->confirmed()
                    ->suffixAction(GeneratePasswordAction::make())
                    ->minLength(8)
                    ->revealable()
                    ->afterStateHydrated(fn ($component) => $component->state(null))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->autocomplete(false),
                TextInput::make('password_confirmation')
                    ->label('Parola Tekrar')
                    ->password()
                    ->required(fn ($livewire) => $livewire instanceof CreateUser)
                    ->maxLength(255)
                    ->password()
                    ->minLength(8)
                    ->revealable()
                    ->dehydrated(false)
                    ->autocomplete(false),

                Select::make('roles')
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
                    ->label('Rol'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
