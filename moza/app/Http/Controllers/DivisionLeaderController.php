<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fallout;
use App\Charts\FalloutStatusChart;
use App\Charts\KecepatanKaryawanChart;
use App\Charts\DetailKecepatanKaryawanChart;


class DivisionLeaderController extends Controller
{
    function dashboardkpi(FalloutStatusChart $falloutStatusChart)
    {   
        // Charts
        // $data[]
        // Kepentingan Pagination data
        $pagination = 10;
        $dataFallout = Fallout::paginate($pagination);

        // Variabel berdasarkan status
        $falloutPi = Fallout::Where('status','PI (Provision Issues)');
        $falloutPs = Fallout::Where('status','PS (Completed)');
        $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
        $falloutCapul = Fallout::Where('status','Capul / Revoke');

        return view('dashboardkpi',[
            'falloutStatusChart' => $falloutStatusChart->build(),
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'falloutCapul' => $falloutCapul
        ]);
    }

    function adduser()
    {
        return view('adduser');
    }

    function addfallout()
    {
        return view('addfallout');
    }

    function halamanFallout(){

        // Kepentingan Pagination data
        $pagination = 10;
        $dataFallout = Fallout::paginate($pagination);

        // Variabel berdasarkan status
        $falloutPi = Fallout::Where('status','PI (Provision Issues)');
        $falloutPs = Fallout::Where('status','PS (Completed)');
        $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
        $falloutCapul = Fallout::Where('status','Capul / Revoke');

        return view('halamanFallout',[
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'falloutCapul' => $falloutCapul
        ]);
    }

    function dashboardkpi2(KecepatanKaryawanChart $chart){ 
        
        // Kepentingan Pagination data
        $pagination = 10;
        $dataFallout = Fallout::paginate($pagination);

        // Variabel berdasarkan status
        $falloutPi = Fallout::Where('status','PI (Provision Issues)');
        $falloutPs = Fallout::Where('status','PS (Completed)');
        $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
        $falloutCapul = Fallout::Where('status','Capul / Revoke');

        return view('dashboardkpi2',[
            'chart'=>$chart->build(),
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'fallout' => $falloutCapul,
        ]);
    }
    
    function detailkecepatankaryawan(DetailKecepatanKaryawanChart $chart){
        
        $pagination = 10;
        $dataFallout = Fallout::paginate($pagination);

        // Variabel berdasarkan status
        $falloutPi = Fallout::Where('status','PI (Provision Issues)');
        $falloutPs = Fallout::Where('status','PS (Completed)');
        $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
        $falloutCapul = Fallout::Where('status','Capul / Revoke');

        return view('dashboardkpi2',[
            'chart'=>$chart->build(),
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'fallout' => $falloutCapul,
        ]);
    }
}
