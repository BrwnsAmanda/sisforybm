<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;

class PerbandinganPenerimaChart extends BarChartWidget
{
    protected static ?string $heading = 'Perbandingan Penerima Manfaat per Pilar (Tahun 2025)';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // Data statis penerima manfaat tahun 2025
        $labels = ['Ekonomi', 'Pendidikan', 'Kesehatan', 'Sosial Kemanusiaan', 'Dakwah'];
        $data = [50, 44, 40, 5, 33];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penerima Manfaat 2025',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59,130,246)',  // biru - Ekonomi
                        'rgba(234,179,8)',   // kuning - Pendidikan
                        'rgba(34,197,9)',   // hijau - Kesehatan
                        'rgba(239,68,68)',   // merah - Sosial
                        'rgba(168,85,247)',  // ungu - Dakwah
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Pilar Program',
                    ],
                ],
                'y' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Penerima Manfaat',
                    ],
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
