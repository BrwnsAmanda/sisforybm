<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarbotResource\Pages;
use App\Models\Marbot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Http;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;

class MarbotResource extends Resource
{
    protected static ?string $model = Marbot::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Marbot';
    protected static ?string $navigationGroup = 'DAKWAH';
    protected static ?int $navigationSort = 3;

    public static function canView($record): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah']);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah']);
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah']);
    }

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

                Forms\Components\Placeholder::make('foto_masjid_current')
                    ->label('Foto Masjid Saat Ini')
                    ->content(function ($record) {
                        if (!$record?->foto_masjid_path) return null;
                        $url = self::getSupabaseUrl($record->foto_masjid_path);
                        return new \Illuminate\Support\HtmlString(
                            "<img src='$url' class='max-h-64 rounded-lg border' />"
                        );
                    })
                    ->hidden(fn ($record) => !$record?->foto_masjid_path),

                Forms\Components\FileUpload::make('foto_masjid_path')
                    ->label(fn ($record) => $record?->foto_masjid_path ? 'Ganti Foto Masjid' : 'Upload Foto Masjid')
                    ->image()
                    ->imagePreviewHeight('250')
                    ->saveUploadedFileUsing(function ($file, callable $set) {
                        return self::uploadToSupabase($file, 'marbot/', $set, 'foto_masjid_path');
                    })
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($record) => !$record?->foto_masjid_path),

                Forms\Components\Placeholder::make('fc_ktp_current')
                    ->label('Foto KTP Saat Ini')
                    ->content(function ($record) {
                        if (!$record?->fc_ktp_path) return null;
                        $url = self::getSupabaseUrl($record->fc_ktp_path);
                        return new \Illuminate\Support\HtmlString(
                            "<img src='$url' class='max-h-64 rounded-lg border' />"
                        );
                    })
                    ->hidden(fn ($record) => !$record?->fc_ktp_path),

                Forms\Components\FileUpload::make('fc_ktp_path')
                    ->label(fn ($record) => $record?->fc_ktp_path ? 'Ganti Foto KTP' : 'Upload Foto KTP')
                    ->image()
                    ->imagePreviewHeight('250')
                    ->saveUploadedFileUsing(function ($file, callable $set) {
                        return self::uploadToSupabase($file, 'marbot/fc-ktp/', $set, 'fc_ktp_path');
                    })
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($record) => !$record?->fc_ktp_path),

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

    protected static function uploadToSupabase($file, string $directory, callable $set, string $field): string
    {
        $bucket = env('SUPABASE_BUCKET');
        $supabaseUrl = env('SUPABASE_URL');
        $serviceKey = env('SUPABASE_SERVICE_KEY');

        $relativePath = $directory . uniqid() . '.' . $file->getClientOriginalExtension();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $serviceKey,
            'apikey' => $serviceKey,
        ])->attach(
            'file',
            file_get_contents($file->getRealPath()),
            $relativePath
        )->post("$supabaseUrl/storage/v1/object/$bucket/$relativePath");

        if ($response->failed()) {
            throw new \Exception('Gagal upload ke Supabase: ' . $response->body());
        }

        $set($field, $relativePath);

        return $relativePath;
    }

    protected static function getSupabaseUrl(?string $path): ?string
    {
        if (!$path) return null;

        $bucket = env('SUPABASE_BUCKET');
        $supabaseUrl = env('SUPABASE_URL');

        return "$supabaseUrl/storage/v1/object/public/$bucket/$path";
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('foto_masjid_path')
                    ->label('Foto Masjid')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return '-';
                        $url = self::getSupabaseUrl($state);
                        return "<img src='$url' class='h-32 w-32 object-cover rounded-lg' />";
                    })
                    ->html(),

                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Marbot')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('no_telp_marbot')
                    ->label('No. Telepon')
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
                Tables\Actions\ViewAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah'])),
                Tables\Actions\EditAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah'])),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah']))
                    ->exports([
                        self::getExcelExport()
                    ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export Semua Data')
                    ->color('success')
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_dakwah']))
                    ->exports([
                        self::getExcelExport()
                    ]),
            ]);
    }

    protected static function getExcelExport(): ExcelExport
{
    return ExcelExport::make()
        ->fromModel()
        ->withFilename('Data-Ekonomi-' . date('Y-m-d'))
        ->withColumns([
            Column::make('nama_produk')->heading('Nama Produk'),
            Column::make('nama_lengkap')->heading('Nama Lengkap'),
            Column::make('nomor_kk')->heading('Nomor KK'),
            Column::make('umur')->heading('Umur'),
            Column::make('no_telp')->heading('No. Telepon'),
            Column::make('alamat_dusun')->heading('Dusun / Jalan'),
            Column::make('alamat_kelurahan')->heading('Kelurahan / Desa'),
            Column::make('alamat_kecamatan')->heading('Kecamatan'),
            Column::make('alamat_kota')->heading('Kota / Kabupaten'),
            Column::make('hasil')->heading('Hasil Verifikasi'),
            Column::make('status_mustahik')->heading('Status Mustahik'),
            Column::make('asnaf')->heading('Asnaf'),
            Column::make('foto_produk')
                ->heading('URL Foto Produk')
                ->formatStateUsing(fn ($state) => self::getSupabaseUrl($state)),
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
