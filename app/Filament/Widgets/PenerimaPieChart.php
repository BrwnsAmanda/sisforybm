<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PenerimaPieChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Penerima Manfaat per Kategori';

    protected function getData(): array
    {
        // Hardcode data distribusi
        $stunting = 120;
        $beasiswa = 80;
        $ekonomi = 150;

        return [
            'datasets' => [
                [
                    'data' => [$stunting, $beasiswa, $ekonomi],
                    'backgroundColor' => [
                        '#16a34a', // hijau
                        '#3b82f6', // biru
                        '#f59e0b', // oranye
                    ],
                ],
            ],
            'labels' => ['Stunting', 'Beasiswa', 'Ekonomi'],
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // bisa juga 'doughnut'
    }
}
