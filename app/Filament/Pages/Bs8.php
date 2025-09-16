<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Bs8 extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Bright Scholarship 8';
    protected static ?string $navigationGroup = 'PENDIDIKAN';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.bs8';
}
