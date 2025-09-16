<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Ekonomi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Ekonomi';
    protected static ?string $navigationGroup = 'EKONOMI'; // tampil di sidebar
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.ekonomi';
}
