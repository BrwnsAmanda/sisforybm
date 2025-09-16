<?php

namespace App\Filament\Resources\StuntingResource\Pages;

use App\Filament\Resources\StuntingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStunting extends EditRecord
{
    protected static string $resource = StuntingResource::class;

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
