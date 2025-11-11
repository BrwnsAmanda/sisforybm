<?php

namespace App\Filament\Resources\SpreadsheetResource\Pages;

use App\Filament\Resources\SpreadsheetResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSpreadsheet extends CreateRecord
{
    protected static string $resource = SpreadsheetResource::class;

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
