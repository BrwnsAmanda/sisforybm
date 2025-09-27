<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;

class PerbandinganPenerimaChart extends BarChartWidget
{
    protected static ?string $heading = 'Perbandingan Penerima Manfaat (Stunting vs Ekonomi)';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Stunting',
                    'data' => [50, 80, 120, 150, 200, 250], // contoh hardcode
                    'backgroundColor' => 'rgba(34,197,94,0.7)', // hijau
                ],
                [
                    'label' => 'Ekonomi',
                    'data' => [30, 60, 90, 120, 160, 210], // contoh hardcode
                    'backgroundColor' => 'rgba(59,130,246,0.7)', // biru
                ],
            ],
            'labels' => ['2019', '2020', '2021', '2022', '2023', '2024'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'stacked' => true,
                ],
                'y' => [
                    'stacked' => true,
                ],
            ],
        ];
    }
}
