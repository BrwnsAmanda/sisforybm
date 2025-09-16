<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Stunting;
use App\Models\Ekonomi;

class TotalStuntings extends BaseWidget
{
    protected static ?string $pollingInterval = null; // nonaktifkan polling

    protected function getCards(): array
    {
        return [
            Card::make('Total Stunting', Stunting::count())
                ->description('Jumlah Penerima Manfaat')
                ->color('success'),

                Card::make('Total Penerima Bright Scholarship', 120)
                ->description('Jumlah Penerima Beasiswa')
                ->color('primary'),

                Card::make('Total Produk', Ekonomi::count())
                ->description('Jumlah Penerima Manfaat')
                ->color('success'),
        ];
    }
}
