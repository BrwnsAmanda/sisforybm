<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Spatie\Permission\Models\Role;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $navigationGroup = 'ADMIN';
    protected static ?int $navigationSort = 6;

    public static function canView($record): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin']);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin']);
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin']);
    }


    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required(fn($livewire) => $livewire instanceof Pages\CreateUser)
                ->minLength(8)
                ->dehydrateStateUsing(fn($state) => bcrypt($state))
                ->dehydrated(fn($state) => filled($state)),

            Select::make('role')
                ->label('Role')
                ->options(fn() => Role::pluck('name', 'name')->toArray())
                ->required()
                ->default('user_biasa'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->sortable()
                    ->badge()
                    ->colors([
                        'success' => 'super_admin',
                        'warning' => 'pj_ekonomi',
                        'info' => 'pj_pendidikan',
                        'danger' => 'pj_kesehatan',
                        'gray' => 'user_biasa',
                    ]),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin'])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
