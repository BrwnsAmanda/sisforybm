<?php

namespace App\Filament\Resources\FamilyStrengtheningResource\Pages;

use App\Filament\Resources\FamilyStrengtheningResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFamilyStrengthening extends CreateRecord
{
    protected static string $resource = FamilyStrengtheningResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
