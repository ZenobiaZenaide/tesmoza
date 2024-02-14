<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

//Models
use App\Models\Fallout;

//Charts
use App\Charts\FalloutStatusChart_unitleader;
use App\Charts\filtertanggal_FalloutStatusChartUnitLeader;

class UnitLeaderController extends Controller
{   
    function dashboardfallout_unitleader(FalloutStatusChart_unitleader $FalloutStatusChartUnitLeader)
    {
        // Mengambil jumlah total submisi fallout
        $totalFallout = Fallout::count();

        // Mendapatkan data untuk masing-masing kategori dan jumlahnya
        $categories = [
            'PS (Completed)' => Fallout::where('status', 'PS (Completed)')->count(),
            'PI (Provision Issues)' => Fallout::where('status', 'PI (Provision Issues)')->count(),
            'Eskalasi' => Fallout::where('status', 'Eskalasi')->count(),
            'Capul / Revoke' => Fallout::where('status', 'Capul/Revoke')->count()
        ];

        // Tambahkan durasi pengerjaan ke dalam data Fallout
        $dataFallout = Fallout::all()->map(function ($fallout) {
            $start = strtotime($fallout->created_at);
            $end = strtotime($fallout->end_at);
            $duration = $end - $start; // Hitung durasi dalam detik

            // Simpan durasi pengerjaan dalam detik
            $fallout->duration_seconds = $duration;

            return $fallout;
        });

        // Urutkan pengerjaan fallout berdasarkan durasi pengerjaan tercepat
        $topFallout = $dataFallout->sortBy('duration_seconds')->take(10);

        return view('unitleader.dashboardfallout_unitleader',[
            'falloutStatusChartUnitLeader' => $FalloutStatusChartUnitLeader->build(),
            'totalFallout' => $totalFallout,
            'categories' => $categories,
            'dataFallout' => $dataFallout,
            'topFallout' => $topFallout
        ]);
    }

    // function dashboardfallout_unitleader(FalloutStatusChart_unitleader $FalloutStatusChartUnitLeader)
    // {
        
    //     // Charts
    //     // $data[]
    //     // Kepentingan Pagination 
    //     $totaldataFallout = Fallout::all();
    //     $pagination = 10;
    //     $dataFallout = Fallout::paginate($pagination);

    //     // Variabel berdasarkan status
    //     $falloutPi = Fallout::Where('status','PI (Provision Issues)');
    //     $falloutPs = Fallout::Where('status','PS (Completed)');
    //     $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
    //     $falloutCapul = Fallout::Where('status','Capul / Revoke');

    //     return view('unitleader.dashboardfallout_unitleader',[
    //         'falloutStatusChartUnitLeader' => $FalloutStatusChartUnitLeader->build(),
    //         'totaldataFallout' => $totaldataFallout,
    //         'dataFallout' => $dataFallout,
    //         'falloutPi' => $falloutPi,
    //         'falloutPs' => $falloutPs,
    //         'falloutEskalasi' => $falloutEskalasi,
    //         'falloutCapul' => $falloutCapul
    //     ]);
    // }

    function filtertanggal_dashboardfallout_unitleader(filtertanggal_FalloutStatusChartUnitLeader $FalloutStatusChartUnitLeader, Request $request)
    {
        $dataFallout = Fallout::when(
                                    $request->date_start && $request->date_end,
                                    function (Builder $builder) use ($request) {
                                        $builder->whereBetween(
                                            DB::raw('DATE(tanggal_fallout)'),
                                            [
                                                $request->date_start,
                                                $request->date_end,
                                            ]
                                        );
                                    }
                                )->get();

        // Variabel berdasarkan status
        $categories = [
            'PS (Completed)' => $dataFallout->where('status', 'PS (Completed)')->count(),
            'PI (Provision Issues)' => $dataFallout->where('status', 'PI (Provision Issues)')->count(),
            'Eskalasi' => $dataFallout->where('status', 'Eskalasi')->count(),
            'Capul / Revoke' => $dataFallout->where('status', 'Capul / Revoke')->count()
        ];

        // Mengambil jumlah total submisi fallout
        $totalFallout = $dataFallout->count();

        // Tambahkan durasi pengerjaan ke dalam data Fallout
        $dataFallout = $dataFallout->map(function ($fallout) {
            $start = strtotime($fallout->created_at);
            $end = strtotime($fallout->end_at);
            $duration = $end - $start; // Hitung durasi dalam detik

            // Simpan durasi pengerjaan dalam detik
            $fallout->duration_seconds = $duration;

            return $fallout;
        });

        // Urutkan pengerjaan fallout berdasarkan durasi pengerjaan tercepat
        $topFallout = $dataFallout->sortBy('duration_seconds')->take(10);

        return view('unitleader.dashboardfallout_unitleader',[
            'request' => $request,
            'falloutStatusChartUnitLeader' => $FalloutStatusChartUnitLeader->build($request),
            'totalFallout' => $totalFallout,
            'categories' => $categories,
            'dataFallout' => $dataFallout,
            'topFallout' => $topFallout
        ]);
    }

    // Function khusus di halaman Fallout
    function halamanfallout_unitleader()
    {

        $pagination = 10;
        $dataFallout = Fallout::paginate($pagination);

        // Variabel berdasarkan status

        $falloutPi = Fallout::Where('status','PI (Provision Issues)');
        $falloutPs = Fallout::Where('status','PS (Completed)');
        $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
        $falloutCapul = Fallout::Where('status','Capul / Revoke');

        return view('unitleader.halamanfallout_unitleader',[
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'fallout' => $falloutCapul,
        ]);
    }

    function filtertanggal_halamanfallout_unitleader(Request $request) {

        $totaldataFallout = Fallout::all();
        $pagination = 10;
        $dataFallout = Fallout::select('order_id','sto','tanggal_fallout','pic','status','ket')
                        ->when(
                            $request->date_start && $request->date_end,
                            function (Builder $builder) use ($request) {
                                $builder->whereBetween(
                                    DB::raw('DATE(tanggal_fallout)'),
                                    [
                                        $request->date_start,
                                        $request->date_end,
                                    ]
                                );
                            }
                        )->paginate(10);

        // Variabel berdasarkan status
        $falloutPi = $dataFallout->where('status','PI (Provision Issues)');
        $falloutPs = $dataFallout->where('status','PS (Completed)');
        $falloutEskalasi = $dataFallout->where('status', 'Eskalasi');
        $falloutCapul = $dataFallout->where('status','Capul / Revoke');

        return view('unitleader.halamanfallout_unitleader',[
            'request' => $request,
            'totaldataFallout' => $totaldataFallout,
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'falloutCapul' => $falloutCapul
        ]);
    }

    function caridatafallout_halamanfallout_unitleader(Request $request) {
        $dataFallout = Fallout::select('order_id','sto','tanggal_fallout','pic','status','ket');

        if ($request->get('search')) {
            $dataFallout = $dataFallout->Where('order_id','LIKE', '%' .$request->get('search').'%')
            ->orWhere('pic', 'LIKE', '%' .$request->get('search').'%')
            ->orWhere('sto', 'LIKE', '%' .$request->get('search').'%')
            ->orWhere('status', 'LIKE', '%' .$request->get('search').'%')
            ->orWhere('ket', 'LIKE', '%' .$request->get('search').'%');
        }

        $dataFallout = $dataFallout->paginate(10);

        return view('unitleader.halamanfallout_unitleader',compact('dataFallout'));
    }

    function addfallout_unitleader() {
        return view('unitleader.addfallout_unitleader');
    }
}
