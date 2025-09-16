<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Bs9 extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Bright Scholarship 9';
    protected static ?string $navigationGroup = 'PENDIDIKAN';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.bs9';
}
