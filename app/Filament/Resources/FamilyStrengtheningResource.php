<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyStrengtheningResource\Pages;
use App\Models\FamilyStrengthening;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;

class FamilyStrengtheningResource extends Resource
{
    protected static ?string $model = FamilyStrengthening::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Family Strengthening';
    protected static ?string $navigationGroup = 'SOSIAL KEMANUSIAAN';
    protected static ?int $navigationSort = 2;

    public static function canView($record): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusiaan']);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusiaan']);
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusiaan']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusiaan']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\DatePicker::make('tanggal_assessment')
                ->label('Tanggal Assessment'),

            Forms\Components\TextInput::make('nama_lengkap')
                ->label('Nama Lengkap')
                ->placeholder('Cth. Ahmad Sulaiman')
                ->required(),

            Forms\Components\TextInput::make('nomor_kk')
                ->label('Nomor KK')
                ->placeholder('Cth. 1234567890123456'),

            Forms\Components\DatePicker::make('tanggal_lahir')
                ->label('Tanggal Lahir'),

            Forms\Components\TextInput::make('umur')
                ->label('Umur')
                ->placeholder('Cth. 24')
                ->numeric(),

            Forms\Components\TextInput::make('no_telp')
                ->label('No. Telepon')
                ->placeholder('08xxxxxxxx'),

            Forms\Components\Textarea::make('alamat')
                ->label('Alamat Tempat Tinggal')
                ->columnSpanFull(),

            Forms\Components\Select::make('hasil')
                ->label('Hasil')
                ->native(false)
                ->options([
                    'LAYAK' => 'Layak',
                    'TIDAK LAYAK' => 'Tidak Layak',
                ]),

            Forms\Components\Select::make('status_mustahik')
                ->label('Status Mustahik')
                ->native(false)
                ->options([
                    'Mustahik' => 'Mustahik',
                    'Non-Mustahik' => 'Non-Mustahik',
                ]),

            Forms\Components\Select::make('asnaf')
                ->label('Asnaf')
                ->native(false)
                ->options([ 'fakir' => 'Fakir', 'miskin' => 'Miskin', 'amil' => 'Amil', 'muallaf' => 'Muallaf', 'riqab' => 'Riqab', 'fisabilillah' => 'Fisabilillah', 'ghorim' => 'Ghorim', 'ibnu_sabil' => 'Ibnu Sabil', ]),

                Forms\Components\TextInput::make('nilai_verifikasi')
                ->label('Nilai Verifikasi')
                ->numeric(),

            Forms\Components\TextInput::make('nilai_akhir')
                ->label('Nilai Akhir')
                ->numeric(),

            Forms\Components\Select::make('keterangan')
                ->label('Keterangan')
                ->native(false)
                ->options([
                    'Lulus' => 'Lulus',
                    'Tidak' => 'Tidak',
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\TextColumn::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->weight('bold')
                        ->size('lg')
                        ->alignCenter()
                        ->searchable()
                        ->color('primary'),

                    Tables\Columns\TextColumn::make('alamat')
                        ->label('Alamat')
                        ->icon('heroicon-o-map-pin'),
                ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusiaan'])),
                Tables\Actions\EditAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusian'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusian'])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusiaan'])),
                ExportBulkAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusiaan']))
                    ->label('Export Data Terpilih'),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export Semua Data')
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_sosial_kemanusiaan']))
                    ->color('success')
                    ->exports([
                        ExcelExport::make()
                            ->fromModel()
                            ->withFilename('Data-Family-Strengthening-' . date('Y-m-d'))
                            ->withColumns([
                                Column::make('tanggal_assessment')->heading('Tanggal Assessment'),
                                Column::make('nama_lengkap')->heading('Nama Lengkap'),
                                Column::make('nomor_kk')->heading('Nomor KK'),
                                Column::make('tanggal_lahir')->heading('Tanggal Lahir'),
                                Column::make('umur')->heading('Umur'),
                                Column::make('no_telp')->heading('No Telepon'),
                                Column::make('alamat')->heading('Alamat'),
                                Column::make('hasil')->heading('Hasil'),
                                Column::make('status_mustahik')->heading('Status Mustahik'),
                                Column::make('asnaf')->heading('Asnaf'),
                                Column::make('nilai_verifikasi')->heading('Nilai Verifikasi'),
                                Column::make('nilai_akhir')->heading('Nilai Akhir'),
                                Column::make('keterangan')->heading('Keterangan'),
                            ]),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilyStrengthenings::route('/'),
            'create' => Pages\CreateFamilyStrengthening::route('/create'),
            'edit' => Pages\EditFamilyStrengthening::route('/{record}/edit'),
        ];
    }
}
