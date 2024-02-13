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
        
        // Charts
        // $data[]
        // Kepentingan Pagination 
        $totaldataFallout = Fallout::all();
        $pagination = 10;
        $dataFallout = Fallout::paginate($pagination);

        // Variabel berdasarkan status
        $falloutPi = Fallout::Where('status','PI (Provision Issues)');
        $falloutPs = Fallout::Where('status','PS (Completed)');
        $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
        $falloutCapul = Fallout::Where('status','Capul / Revoke');

        return view('unitleader.dashboardfallout_unitleader',[
            'falloutStatusChartUnitLeader' => $FalloutStatusChartUnitLeader->build(),
            'totaldataFallout' => $totaldataFallout,
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'falloutCapul' => $falloutCapul
        ]);
    }

    function filtertanggal_dashboardfallout_unitleader(filtertanggal_FalloutStatusChartUnitLeader $FalloutStatusChartUnitLeader, Request $request)
    {
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

        return view('unitleader.dashboardfallout_unitleader',[
            'request' => $request,
            'falloutStatusChartUnitLeader' => $FalloutStatusChartUnitLeader->build($request),
            'totaldataFallout' => $totaldataFallout,
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'falloutCapul' => $falloutCapul
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
