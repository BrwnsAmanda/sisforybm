<?php

namespace App\Filament\Resources\SpreadsheetResource\Pages;

use App\Filament\Resources\SpreadsheetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpreadsheets extends ListRecords
{
    protected static string $resource = SpreadsheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
