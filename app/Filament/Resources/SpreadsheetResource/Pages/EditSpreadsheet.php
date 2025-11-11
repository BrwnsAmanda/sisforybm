<?php

namespace App\Filament\Resources\SpreadsheetResource\Pages;

use App\Filament\Resources\SpreadsheetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpreadsheet extends EditRecord
{
    protected static string $resource = SpreadsheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Setelah create, redirect ke index (tabel list data)
        return $this->getResource()::getUrl('index');
    }
}
