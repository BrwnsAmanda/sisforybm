<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EkonomiResource\Pages;
use App\Models\Ekonomi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EkonomiResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Ekonomi';
    protected static ?string $navigationGroup = 'EKONOMI'; // tampil di sidebar
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('foto_produk')
                ->label('Foto Produk')
                ->image(),

            Forms\Components\TextInput::make('nama_produk')
                ->label('Nama Produk')
                ->required()
                ->placeholder('Masukkan nama produk'),

            Forms\Components\DatePicker::make('tanggal_verifikasi')
                ->label('Tanggal Verifikasi'),

            Forms\Components\TextInput::make('nama_lengkap')
                ->placeholder('Cth. Ahmad Sulaiman')
                ->label('Nama Lengkap'),

            Forms\Components\TextInput::make('nomor_kk')
                ->placeholder('Cth. 1234567890123456')
                ->label('Nomor KK'),

            Forms\Components\TextInput::make('umur')
                ->numeric()
                ->placeholder('Cth. 24')
                ->label('Umur'),

            Forms\Components\TextInput::make('no_telp')
                ->placeholder('08xxxxxxxx')
                ->label('No. Telepon'),


                Forms\Components\TextInput::make('alamat_dusun')
                    ->placeholder('Cth. Melati')
                    ->label('Dusun / Jalan'),
                Forms\Components\TextInput::make('alamat_kelurahan')
                    ->placeholder('Cth. Sukamaju')
                    ->label('Kelurahan / Desa'),
                Forms\Components\TextInput::make('alamat_kecamatan')
                    ->placeholder('Cth. Somba Opu')
                    ->label('Kecamatan'),
                Forms\Components\TextInput::make('alamat_kota')
                    ->placeholder('Cth. Gowa')
                    ->label('Kota / Kabupaten'),

            Forms\Components\Select::make('hasil')
                ->label('Hasil')
                ->native(false)
                ->options([
                    'layak' => 'Layak',
                    'tidak_layak' => 'Tidak Layak',
                ]),

            Forms\Components\Select::make('status_mustahik')
                ->label('Status Mustahik')
                ->native(false)
                ->options([
                    'mustahik' => 'Mustahik',
                    'non_mustahik' => 'Non-Mustahik',
                ]),

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
                    Tables\Columns\ImageColumn::make('foto_produk')
                        ->label('Foto Produk')
                        ->height(120)
                        ->width(200),
                    Tables\Columns\TextColumn::make('nama_produk')
                        ->label('Nama Produk')
                        ->weight('bold')
                        ->color('primary'),
                    Tables\Columns\TextColumn::make('alamat_kota')
                        ->label('Lokasi')
                        ->icon('heroicon-o-map-pin'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEkonomis::route('/'),
            'create' => Pages\CreateEkonomi::route('/create'),
            'edit' => Pages\EditEkonomi::route('/{record}/edit'),
        ];
    }
}
