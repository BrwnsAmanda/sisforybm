<?php

namespace App\Filament\Resources\StuntingResource\Pages;

use App\Filament\Resources\StuntingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStunting extends CreateRecord
{
    protected static string $resource = StuntingResource::class;

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
