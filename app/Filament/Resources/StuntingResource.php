<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StuntingResource\Pages;
use App\Models\Stunting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;


class StuntingResource extends Resource
{
    protected static ?string $model = Stunting::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Stunting';
    protected static ?string $navigationGroup = 'KESEHATAN';
    protected static ?int $navigationSort = 5;

    public static function canView($record): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan']);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan']);
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap')->required()
                    ->label('Nama Lengkap')
                    ->placeholder('Cth. Ahmad Sulaiman'),
                Forms\Components\TextInput::make('nomor_kk')->required()
                    ->label('Nomor KK')
                    ->placeholder('Cth. 1234567890123456'),
                Forms\Components\DatePicker::make('tanggal_lahir')->required()->label('Tanggal Lahir'),
                Forms\Components\TextInput::make('umur')->numeric()->required()
                    ->label('Umur')
                    ->placeholder('Cth. 24'),
                Forms\Components\Select::make('agama')
                    ->label('Agama')
                    ->options([
                        'islam' => 'Islam',
                        'kristen' => 'Kristen',
                        'katolik' => 'Katolik',
                        'hindu' => 'Hindu',
                        'budha' => 'Budha',
                        'konghucu' => 'Konghucu',
                    ])
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('dusun')
                    ->label('Dusun')
                    ->placeholder('Cth. Melati'),
                Forms\Components\TextInput::make('kelurahan_desa')
                    ->label('Kelurahan/Desa')
                    ->placeholder('Cth. Sukamaju'),
                Forms\Components\TextInput::make('kecamatan')
                    ->label('Kecamatan')
                    ->placeholder('Cth. Somba Opu'),
                Forms\Components\TextInput::make('kab_kota')
                    ->label('Kab/Kota')
                    ->placeholder('Cth. Gowa'),
                Forms\Components\TextInput::make('telepon')
                    ->label('Telepon')
                    ->placeholder('Cth. 081234567890'),
                Forms\Components\TextInput::make('pekerjaan_ortu')
                    ->label('Pekerjaan Ortu')
                    ->placeholder('Cth. Petani'),
                Forms\Components\TextInput::make('jumlah_tanggungan')->numeric()
                    ->label('Jumlah Tanggungan')
                    ->placeholder('Cth. 3'),
                Forms\Components\TextInput::make('total_pengeluaran')
                    ->numeric()
                    ->label('Total Pengeluaran')
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, $get) =>
                        $set('selisih', ($get('total_pendapatan') ?? 0) - ($state ?? 0))
                    ),

                Forms\Components\TextInput::make('total_pendapatan')
                    ->numeric()
                    ->label('Total Pendapatan')
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, $get) =>
                        $set('selisih', ($state ?? 0) - ($get('total_pengeluaran') ?? 0))
                    ),

                Forms\Components\TextInput::make('selisih')
                    ->label('Selisih')
                    ->disabled()
                    ->dehydrated(true),

                Forms\Components\Select::make('komitmen_program')
                    ->label('Komitmen Program')
                    ->options([
                        'ya' => 'Ya',
                        'tidak' => 'Tidak',
                    ])
                    ->native(false),
                Forms\Components\Select::make('hasil')
                    ->label('Hasil')
                    ->options([
                        'layak' => 'Layak',
                        'tidak_layak' => 'Tidak Layak',
                    ])
                    ->native(false),
                Forms\Components\Select::make('status_mustahik')
                    ->label('Status Mustahik')
                    ->options([
                        'mustahik' => 'Mustahik',
                        'non_mustahik' => 'Non Mustahik',
                    ])
                    ->native(false),
                Forms\Components\Select::make('asnaf')
                    ->label('Asnaf')
                    ->options([
                        'fakir' => 'Fakir',
                        'miskin' => 'Miskin',
                        'amil' => 'Amil',
                        'muallaf' => 'Muallaf',
                        'riqab' => 'Riqab',
                        'fisabilillah' => 'Fisabilillah',
                        'ghorim' => 'Ghorim',
                        'ibnu_sabil' => 'Ibnu Sabil',
                    ])
                    ->native(false),
                Forms\Components\DatePicker::make('tanggal_penerimaan')->required()->label('Tanggal Penerimaan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')->label('Nama Lengkap')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nomor_kk')->label('Nomor KK')->sortable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')->date()->label('Tanggal Lahir'),
                Tables\Columns\TextColumn::make('dusun')->label('Dusun')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kelurahan_desa')->label('Kelurahan/Desa')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kab_kota')->label('Kab/Kota')->sortable()->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan'])),
                Tables\Actions\EditAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan'])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan'])),
                ExportBulkAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan']))
                    ->label('Export Data Terpilih'),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export Semua Data')
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_kesehatan']))
                    ->color('success')
                    ->exports([
                        ExcelExport::make()
                            ->fromModel()
                            ->withFilename('Data-Stunting-' . date('Y-m-d'))
                            ->withColumns([
                                Column::make('nama_lengkap')->heading('Nama Lengkap'),
                                Column::make('nomor_kk')->heading('Nomor KK'),
                                Column::make('tanggal_lahir')->heading('Tanggal Lahir'),
                                Column::make('umur')->heading('Umur'),
                                Column::make('agama')->heading('Agama'),
                                Column::make('dusun')->heading('Dusun'),
                                Column::make('kelurahan_desa')->heading('Kelurahan/Desa'),
                                Column::make('kecamatan')->heading('Kecamatan'),
                                Column::make('kab_kota')->heading('Kab/Kota'),
                                Column::make('telepon')->heading('Telepon'),
                                Column::make('pekerjaan_ortu')->heading('Pekerjaan Ortu'),
                                Column::make('jumlah_tanggungan')->heading('Jumlah Tanggungan'),
                                Column::make('total_pengeluaran')->heading('Total Pengeluaran'),
                                Column::make('total_pendapatan')->heading('Total Pendapatan'),
                                Column::make('selisih')->heading('Selisih'),
                                Column::make('komitmen_program')->heading('Komitmen Program'),
                                Column::make('hasil')->heading('Hasil'),
                                Column::make('status_mustahik')->heading('Status Mustahik'),
                                Column::make('asnaf')->heading('Asnaf'),
                                Column::make('tanggal_penerimaan')->heading('Tanggal Penerimaan'),
                            ]),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStuntings::route('/'),
            'create' => Pages\CreateStunting::route('/create'),
            'edit' => Pages\EditStunting::route('/{record}/edit'),
        ];
    }
}
