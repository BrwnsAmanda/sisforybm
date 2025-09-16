<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Stunting extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Stunting';
    protected static ?string $navigationGroup = 'KESEHATAN';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.stunting';
}
