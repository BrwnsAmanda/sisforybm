<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Stunting;
use App\Models\Ekonomi;
use App\Models\Marbot;
use App\Models\FamilyStrengthening;

class TotalStuntings extends BaseWidget
{
    protected static ?string $pollingInterval = null; // nonaktifkan polling
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        return [
            Card::make('Pilar Kesehatan - Stunting', Stunting::count())
                ->description('Jumlah Penerima Manfaat')
                ->color('success'),

                Card::make('Pilar Pendidikan - Bright Scholarship', 120)
                ->description('Jumlah Penerima Beasiswa')
                ->color('primary'),

                Card::make('Pilar Ekonomi - Total Produk', Ekonomi::count())
                ->description('Jumlah Penerima Manfaat')
                ->color('primary'),

                Card::make('Pilar Dakwah - Marbot', Marbot::count())
                ->description('Jumlah Marbot')
                ->color('success'),

                Card::make('Pilar Sosial Kemanusiaan - Family Strengthening', FamilyStrengthening::count())
                ->description('Jumlah Penerima Manfaat')
                ->color('primary'),
        ];
    }
}
