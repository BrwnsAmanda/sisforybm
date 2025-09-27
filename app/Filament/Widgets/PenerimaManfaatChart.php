<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;

class PenerimaManfaatChart extends LineChartWidget
{
    protected static ?string $heading = 'Grafik Penerima Manfaat (Tahun ke Tahun)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penerima Manfaat',
                    'data' => [180, 250, 200, 400, 500], // hardcode data
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.3)',
                ],
            ],
            'labels' => ['2020', '2021', '2022', '2023', '2024'],
        ];
    }
}
