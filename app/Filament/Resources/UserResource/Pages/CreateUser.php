<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

     protected function getRedirectUrl(): string
    {
        // Setelah create, redirect ke index (tabel list data)
        return $this->getResource()::getUrl('index');
    }
}
