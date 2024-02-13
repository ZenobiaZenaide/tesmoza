<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Fallout;

class FalloutStatusChart_unitleader
{
    protected $chart;

    public function __construct(LarapexChart $FalloutStatusChartUnitLeader)
    {
        $this->chart = $FalloutStatusChartUnitLeader;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $falloutData = Fallout::all();

        // Data untuk chart
        $data = [
            $falloutData->where('status','Eskalasi')->count(),
            $falloutData->where('status','PI (Provision Issues)')->count(),
            $falloutData->where('status','PS (Completed)')->count(),
            $falloutData->where('status','Capul / Revoke')->count(),
        ];

        // Labeling untuk chart
        $label = [
            'Eskalasi',
            'PI (Provision Issues)',
            'PS (Completed)',
            'Capul / Revoke',
        ];

        return $this->chart->donutChart()
            ->setTitle('Perbandingan Status Fallout')
            ->setSubtitle('Season 2021.')
            ->addData($data)
            ->setLabels($label);
    }
}
