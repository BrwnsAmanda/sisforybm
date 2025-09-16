<?php

namespace App\Filament\Resources\MarbotResource\Pages;

use App\Filament\Resources\MarbotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarbots extends ListRecords
{
    protected static string $resource = MarbotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


}
