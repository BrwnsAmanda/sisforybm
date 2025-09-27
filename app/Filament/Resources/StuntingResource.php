<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StuntingResource\Pages;
use App\Models\Stunting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class StuntingResource extends Resource
{
    protected static ?string $model = Stunting::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Stunting';
    protected static ?string $navigationGroup = 'KESEHATAN';
    protected static ?int $navigationSort = 1;

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
    ->dehydrated(true), // biar tetap tersimpan ke database


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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
