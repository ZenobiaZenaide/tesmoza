<?php

namespace App\Charts;

use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;

use App\Models\Fallout;

class filtertanggal_FalloutStatusChartUnitLeader
{
    protected $chart;

    public function __construct(LarapexChart $FalloutStatusChartUnitLeader)
    {
        $this->chart = $FalloutStatusChartUnitLeader;
    }

    public function build($request): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $dateStart = $request->date_start;
        $dateEnd = $request->date_end;

        $falloutData = Fallout::query()
            ->whereBetween('tanggal_fallout', [$dateStart, $dateEnd])
            ->get();

        // Data untuk chart
        $data = [
            $falloutData->where('status', 'Eskalasi')->count(),
            $falloutData->where('status', 'PI (Provision Issues)')->count(),
            $falloutData->where('status', 'PS (Completed)')->count(),
            $falloutData->where('status', 'Capul / Revoke')->count(),
        ];

        // Labeling untuk chart
        $label = [
            'Eskalasi',
            'PI (Provision Issues)',
            'PS (Completed)',
            'Capul / Revoke'
        ];

        return $this->chart->donutChart()
            ->setTitle('Perbandingan Status Fallout')
            ->setSubtitle('Season 2021.')
            ->addData($data)
            ->setLabels($label);
    }
}
