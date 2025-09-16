<?php

namespace App\Filament\Resources\EkonomiResource\Pages;

use App\Filament\Resources\EkonomiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEkonomi extends EditRecord
{
    protected static string $resource = EkonomiResource::class;

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
