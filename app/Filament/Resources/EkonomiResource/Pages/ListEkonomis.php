<?php

namespace App\Filament\Resources\EkonomiResource\Pages;

use App\Filament\Resources\EkonomiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEkonomis extends ListRecords
{
    protected static string $resource = EkonomiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
