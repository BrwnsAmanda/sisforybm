<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EkonomiResource\Pages;
use App\Models\Ekonomi;
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

class EkonomiResource extends Resource
{
    protected static ?string $model = Ekonomi::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Ekonomi';
    protected static ?string $navigationGroup = 'EKONOMI';
    protected static ?int $navigationSort = 1;

    public static function canView($record): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi']);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi']);
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Placeholder::make('foto_produk_current')
                ->label('Foto Saat Ini')
                ->content(function ($record) {
                    if (!$record?->foto_produk) return null;
                    $url = self::getSupabaseUrl($record->foto_produk);
                    return new \Illuminate\Support\HtmlString(
                        "<img src='$url' class='max-h-64 rounded-lg border' />"
                    );
                })
                ->hidden(fn ($record) => !$record?->foto_produk),

            Forms\Components\FileUpload::make('foto_produk')
                ->label(fn ($record) => $record?->foto_produk ? 'Ganti Foto' : 'Foto Produk')
                ->image()
                ->imagePreviewHeight('250')
                ->saveUploadedFileUsing(function ($file, callable $set) {
                    return self::uploadToSupabase($file, 'ekonomi/', $set, 'foto_produk');
                })
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn ($record) => !$record?->foto_produk),

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

        if (str_starts_with($path, 'http')) return $path;

        $bucket = env('SUPABASE_BUCKET');
        $supabaseUrl = env('SUPABASE_URL');

        return "$supabaseUrl/storage/v1/object/public/$bucket/$path";
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
                Tables\Columns\TextColumn::make('foto_produk')
                    ->label('Foto Produk')
                    ->alignCenter()
                    ->formatStateUsing(function ($state) {
                        if (!$state) return '-';
                        $url = self::getSupabaseUrl($state);
                        return "<img src='$url' class='h-32 w-full object-cover rounded-lg' />";
                    })
                    ->html(),

                Tables\Columns\TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->weight('bold')
                    ->color('primary')
                    ->size('lg')
                    ->alignCenter()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Pemilik')
                    ->icon('heroicon-o-user')
                    ->searchable(),

                Tables\Columns\TextColumn::make('alamat_kota')
                    ->label('Lokasi')
                    ->icon('heroicon-o-map-pin')
                    ->searchable(),
            ]),
        ])
        ->actions([
            Tables\Actions\ViewAction::make()
                ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi'])),
            Tables\Actions\EditAction::make()
                ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi'])),
            Tables\Actions\DeleteAction::make()
                ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi'])),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make()
                ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi'])),
            ExportBulkAction::make()
                ->label('Export Data Terpilih')
                ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi']))
                ->exports([
                    self::getExcelExport()
                ]),
        ])
        ->headerActions([
            ExportAction::make()
                ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'pj_ekonomi']))
                ->label('Export Semua Data')
                ->color('success')
                ->exports([
                    self::getExcelExport()
                ]),
        ])
        ->defaultSort('created_at', 'desc');
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
            Column::make('foto_produk')->heading('URL Foto Produk'),
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
