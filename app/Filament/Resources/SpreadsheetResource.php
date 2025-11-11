<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpreadsheetResource\Pages;
use App\Models\Spreadsheet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Navigation\NavigationItem;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;


class SpreadsheetResource extends Resource
{
    protected static ?string $model = Spreadsheet::class;
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Spreadsheet Manager';
    protected static ?string $navigationGroup = 'PENDIDIKAN';
    protected static ?int $navigationSort = 4;

    public static function canView($record): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_pendidikan']);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_pendidikan']);
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_pendidikan']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_pendidikan']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Judul Spreadsheet')
                ->required(),
            Forms\Components\TextInput::make('category')
                ->label('Kategori')
                ->default('PENDIDIKAN'),
            Forms\Components\TextInput::make('url')
                ->label('URL Embed Google Sheet')
                ->required()
                ->placeholder('https://docs.google.com/spreadsheets/...'),
        ]);
    }

   public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul'),
                Tables\Columns\TextColumn::make('category')->label('Kategori'),
                Tables\Columns\TextColumn::make('url')->label('URL')->limit(40),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_pendidikan'])),
                Tables\Actions\EditAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_pendidikan'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_pendidikan'])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_pendidikan'])),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpreadsheets::route('/'),
            'create' => Pages\CreateSpreadsheet::route('/create'),
            'edit' => Pages\EditSpreadsheet::route('/{record}/edit'),
        ];
    }

    public static function getNavigationItems(): array
{
    $items = [];

    $panelPath = config('filament.path', 'adminybm');

    foreach (\App\Models\Spreadsheet::all() as $sheet) {
        $items[] = NavigationItem::make($sheet->title)
            ->group($sheet->category ?? 'Spreadsheet')
            ->url(url($panelPath . '/spreadsheet-viewer?id=' . $sheet->id))
            ->icon('heroicon-o-book-open')
            ->sort(10);
    }

    return array_merge(parent::getNavigationItems(), $items);

}





}
