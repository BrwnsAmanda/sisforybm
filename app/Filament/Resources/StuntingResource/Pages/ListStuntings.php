<?php

namespace App\Filament\Resources\StuntingResource\Pages;

use App\Filament\Resources\StuntingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStuntings extends ListRecords
{
    protected static string $resource = StuntingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
