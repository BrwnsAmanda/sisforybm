<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarbotResource\Pages;
use App\Models\Marbot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MarbotResource extends Resource
{
    protected static ?string $model = Marbot::class;

        protected static ?string $navigationIcon = 'heroicon-o-building-library';
        protected static ?string $navigationLabel = 'Marbot';
    protected static ?string $navigationGroup = 'DAKWAH'; // tampil di group Dakwah
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->placeholder('Masukkan nama lengkap')
                    ->required(),

                Forms\Components\TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->placeholder('Contoh: Marbot, Imam, Takmir'),

                Forms\Components\TextInput::make('nama_verifikator')
                    ->label('Nama Verifikator')
                    ->placeholder('Masukkan nama verifikator'),

                Forms\Components\TextInput::make('unit_kerja')
                    ->label('Unit Kerja')
                    ->placeholder('Masukkan unit kerja'),

                Forms\Components\TextInput::make('no_telp_marbot')
                    ->label('No. Telp Marbot')
                    ->placeholder('08xxxxxxxx'),

                Forms\Components\TextInput::make('no_telp_masjid')
                    ->label('No. Telp Masjid')
                    ->placeholder('08xxxxxxxx'),

                Forms\Components\TextInput::make('nama_masjid')
                    ->label('Nama Masjid')
                    ->placeholder('Masukkan nama masjid'),

                Forms\Components\Textarea::make('alamat_masjid')
                    ->label('Alamat Masjid')
                    ->placeholder('Masukkan alamat masjid'),

                Forms\Components\FileUpload::make('foto_masjid_path')
                    ->label('Foto Masjid')
                    ->image()
                    ->directory('foto-masjid')
                    ->placeholder('Upload foto masjid'),

                Forms\Components\FileUpload::make('fc_ktp_path')
                    ->label('Foto KTP')
                    ->image()
                    ->directory('fc-ktp'),

                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->placeholder('Pilih tanggal lahir'),

                Forms\Components\TextInput::make('nik')
                    ->label('NIK')
                    ->placeholder('Masukkan NIK'),

                Forms\Components\TextInput::make('no_rekening_bri')
                    ->label('No. Rekening BRI')
                    ->placeholder('Masukkan nomor rekening'),

                Forms\Components\TextInput::make('atas_nama_rekening')
                    ->label('Atas Nama Rekening')
                    ->placeholder('Masukkan nama pemilik rekening'),

                Forms\Components\TextInput::make('alamat_rekening')
                    ->label('Alamat Rekening')
                    ->placeholder('Masukkan alamat sesuai rekening'),

                Forms\Components\Select::make('status_pernikahan')
                    ->label('Status Pernikahan')
                    ->options([
                        'lajang' => 'Lajang',
                        'menikah' => 'Menikah',
                        'duda/janda' => 'Duda/Janda',
                    ])
                    ->placeholder('Pilih status pernikahan'),

                Forms\Components\TextInput::make('pendapatan_marbot')
                    ->label('Pendapatan Marbot')
                    ->numeric()
                    ->placeholder('Masukkan jumlah pendapatan'),

                Forms\Components\TextInput::make('total_pendapatan_lain')
                    ->label('Total Pendapatan Lain')
                    ->numeric()
                    ->placeholder('Masukkan pendapatan tambahan'),

                Forms\Components\Textarea::make('sumber_pendapatan_lainnya')
                    ->label('Sumber Pendapatan Lain')
                    ->placeholder('Contoh: Dagang, Pekerjaan sampingan'),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->contentGrid([
            'md' => 2,
            'lg' => 3,
        ])
        ->columns([
            Tables\Columns\ImageColumn::make('foto_masjid_path')
                ->label('Foto Masjid')
                ->square()
                ->height(150)
                ->circular(false),

            Tables\Columns\TextColumn::make('nama_lengkap')
                ->label('Nama Marbot')
                ->weight('bold')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('nama_masjid')
                ->label('Nama Masjid')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('alamat_masjid')
                ->label('Alamat Masjid')
                ->limit(30)
                ->tooltip(fn ($record) => $record->alamat_masjid),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMarbots::route('/'),
            'create' => Pages\CreateMarbot::route('/create'),
            'edit' => Pages\EditMarbot::route('/{record}/edit'),
        ];
    }
}
