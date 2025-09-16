<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Bs10 extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Bright Scholarship 10';
    protected static ?string $navigationGroup = 'PENDIDIKAN';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.bs10';
}
