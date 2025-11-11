<?php

namespace App\Filament\Resources\EkonomiResource\Pages;

use App\Filament\Resources\EkonomiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEkonomi extends CreateRecord
{
    protected static string $resource = EkonomiResource::class;

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

