<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Family extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Family Strengthening';
    protected static ?string $navigationGroup = 'SOSIAL KEMANUSIAAN'; // tampil di sidebar
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.familystrengthening';
}
