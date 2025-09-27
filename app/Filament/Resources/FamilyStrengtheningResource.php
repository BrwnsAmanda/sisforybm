<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyStrengtheningResource\Pages;
use App\Models\FamilyStrengthening;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FamilyStrengtheningResource extends Resource
{
    protected static ?string $model = FamilyStrengthening::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Family Strengthening';
    protected static ?string $navigationGroup = 'SOSIAL KEMANUSIAAN';
    protected static ?int $navigationSort = 1;

    // FORM INPUT
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\DatePicker::make('tanggal_assessment')
                ->label('Tanggal Assessment'),

            Forms\Components\TextInput::make('nama_lengkap')
                ->label('Nama Lengkap')
                ->required()
                ->placeholder('Cth. Ahmad Sulaiman'),

            Forms\Components\TextInput::make('nomor_kk')
                ->label('Nomor KK')
                ->placeholder('Cth. 1234567890123456'),

            Forms\Components\DatePicker::make('tanggal_lahir')
                ->label('Tanggal Lahir'),

            Forms\Components\TextInput::make('umur')
                ->label('Umur')
                ->numeric(),

            Forms\Components\TextInput::make('no_telp')
                ->label('No. Telepon')
                ->placeholder('08xxxxxxxx'),

            Forms\Components\Textarea::make('alamat')
                ->label('Alamat Tempat Tinggal')
                ->placeholder('Dusun / Jalan, Kelurahan / Desa, Kecamatan, Kota / Kabupaten')
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

            Forms\Components\TextInput::make('asnaf')
                ->label('Asnaf'),

            Forms\Components\TextInput::make('nilai_verifikasi')
                ->label('Nilai Verifikasi')
                ->numeric(),

            //Forms\Components\TextInput::make('lwa')
               // ->label('LWA (Daftar Hadir, Kesungguhan, Kejujuran)')
               // ->numeric(),

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

    // TABLE TAMPILAN DATA
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
                        ->color('primary'),

                    Tables\Columns\TextColumn::make('alamat')
                        ->label('Alamat')
                        ->icon('heroicon-o-map-pin'),

                    Tables\Columns\TextColumn::make('hasil')
                        ->label('Hasil')
                        ->badge()
                        ->colors([
                            'success' => 'LAYAK',
                            'danger' => 'TIDAK LAYAK',
                        ]),

                    Tables\Columns\TextColumn::make('status_mustahik')
                        ->label('Mustahik / Non-Mustahik')
                        ->badge()
                        ->colors([
                            'primary' => 'Mustahik',
                            'gray' => 'Non-Mustahik',
                        ]),

                    Tables\Columns\TextColumn::make('nilai_akhir')
                        ->label('Nilai Akhir')
                        ->numeric()
                        ->sortable(),
                ]),
            ])
            ->filters([])
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
