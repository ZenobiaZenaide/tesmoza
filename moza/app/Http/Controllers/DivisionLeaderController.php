<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

    public function createAccount(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'id_employee' => 'required|string|max:255',
            'role' => 'required|string|in:Division Leader,Unit Leader,Employee',
            'password' => 'required|string|min:6',
        ]);
    
        // Mapping nilai peran dari UI ke nilai yang akan disimpan di database
        $roleMap = [
            'Division Leader' => 'divisionleader',
            'Unit Leader' => 'unitleader',
            'Employee' => 'employee',
        ];
    
        // Memperoleh nilai peran yang sesuai dari peta
        $role = $roleMap[$request->input('role')];
    
        // Buat akun baru
        $user = User::create([
            'name' => $request->input('name'),
            'id_employee' => $request->input('id_employee'),
            'role' => $role,
            'password' => bcrypt($request->input('password')), // Menggunakan bcrypt untuk menyimpan password secara aman
        ]);
    
        // Jika berhasil, redirect ke halaman tertentu
        return redirect()->route('adduser')->with('success', 'Account created successfully.');
    }    

    function addfallout()
    {
        $created_at = now()->format('H:i:s');
        session()->put('created_at', $created_at);

        return view('addfallout');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'order_id' => 'required|string',
            'status_message' => 'required|string',
            'sto' => 'required|string',
            'status' => 'required|string|in:PS (Completed),PI (Provision Issues),Capul/Revoke,Eskalasi',
            'ket' => $request->status === 'Eskalasi' ? 'required|string' : '',
        ]);

        // Simpan data fallout ke dalam database
        $fallout = new Fallout();
        $fallout->order_id = $validatedData['order_id'];
        $fallout->status_message = $validatedData['status_message'];
        $fallout->sto = $validatedData['sto'];
        $fallout->status = $validatedData['status'];
        $fallout->ket = $validatedData['ket'] ?? null; // Keterangan hanya jika status Eskalasi
        $fallout->tanggal_fallout = now()->toDateString(); // Tanggal saat ini
        $fallout->pic = auth()->user()->name; // User yang mengisi data
        // Memperoleh waktu created_at dari session
        $created_at = session()->get('created_at');
        $fallout->created_at = $created_at;

        $fallout->save();

        // Update end_at pada waktu saat ini
        $fallout->update(['end_at' => now()->format('H:i:s')]);

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('halamanFallout')->with('success', 'Data Fallout berhasil disimpan!');
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

        return view('detailkecepatankaryawan',[
            'chart'=>$chart->build(),
            'dataFallout' => $dataFallout,
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'fallout' => $falloutCapul,
        ]);
    }
}
