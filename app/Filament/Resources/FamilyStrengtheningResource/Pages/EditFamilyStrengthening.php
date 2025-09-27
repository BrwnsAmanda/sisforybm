<?php

namespace App\Filament\Resources\FamilyStrengtheningResource\Pages;

use App\Filament\Resources\FamilyStrengtheningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFamilyStrengthening extends EditRecord
{
    protected static string $resource = FamilyStrengtheningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
