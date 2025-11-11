<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Spreadsheet;

class SpreadsheetViewer extends Page
{
    protected static ?string $slug = 'spreadsheet-viewer';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.pages.spreadsheet-viewer';
    protected static bool $shouldRegisterNavigation = false;

    public $spreadsheet;

    public function mount(): void
    {
        $id = request()->query('id');
        $this->spreadsheet = Spreadsheet::findOrFail($id);
    }

    public static function getUrl(
        array $parameters = [],
        bool $isAbsolute = true,
        ?string $panel = null,
        ?\Illuminate\Database\Eloquent\Model $tenant = null
    ): string {
        $panelPath = $panel ?? config('filament.path', 'adminybm');
        $query = http_build_query($parameters);

        return url($panelPath . '/' . static::$slug . ($query ? '?' . $query : ''));
    }
}
