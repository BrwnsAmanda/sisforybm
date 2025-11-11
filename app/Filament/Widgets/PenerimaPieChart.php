<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PenerimaPieChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Penerima Manfaat per Pilar';
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $ekonomi = 230;
        $pendidikan = 180;
        $kesehatan = 210;
        $sosial = 160;
        $dakwah = 140;

        return [
            'datasets' => [
                [
                    'data' => [
                        $ekonomi,
                        $pendidikan,
                        $kesehatan,
                        $sosial,
                        $dakwah,
                    ],
                    'backgroundColor' => [
                        '#3b82f6', // biru - Ekonomi
                        '#eab308', // kuning - Pendidikan
                        '#22c55e', // hijau - Kesehatan
                        '#ef4444', // merah - Sosial
                        '#a855f7', // ungu - Dakwah
                    ],
                ],
            ],
            'labels' => [
                'Ekonomi',
                'Pendidikan',
                'Kesehatan',
                'Sosial Kemanusiaan',
                'Dakwah',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
