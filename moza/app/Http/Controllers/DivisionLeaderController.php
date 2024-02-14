<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\FalloutExport;
use Maatwebsite\Excel\Facades\Excel;

//Models
use App\Models\User;
use App\Models\Fallout;

//Charts
use App\Charts\FalloutStatusChart;
use App\Charts\KecepatanKaryawanChart;
use App\Charts\DetailKecepatanKaryawanChart;


class DivisionLeaderController extends Controller
{
    public function dashboardkpi(FalloutStatusChart $falloutStatusChart)
    {
        // Inisialisasi chart
        $chart = $falloutStatusChart->build();

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

        return view('dashboardkpi', [
            'totalFallout' => $totalFallout,
            'categories' => $categories,
            'dataFallout' => $dataFallout,
            'topFallout' => $topFallout,
            'falloutStatusChart' => $chart
        ]);
    }

    public function filtertanggal(FalloutStatusChart $falloutStatusChart, Request $request)
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

        // Tambahkan durasi pengerjaan ke dalam data Fallout
        $dataFallout->each(function ($fallout) {
            $start = strtotime($fallout->created_at);
            $end = strtotime($fallout->end_at);
            $duration = $end - $start; // Hitung durasi dalam detik

            // Simpan durasi pengerjaan dalam detik
            $fallout->duration_seconds = $duration;
        });

        // Variabel berdasarkan status
        $categories = [
            'PS (Completed)' => $dataFallout->where('status', 'PS (Completed)')->count(),
            'PI (Provision Issues)' => $dataFallout->where('status', 'PI (Provision Issues)')->count(),
            'Eskalasi' => $dataFallout->where('status', 'Eskalasi')->count(),
            'Capul / Revoke' => $dataFallout->where('status', 'Capul / Revoke')->count()
        ];

        // Mengambil jumlah total submisi fallout
        $totalFallout = $dataFallout->count();

        // Urutkan pengerjaan fallout berdasarkan durasi pengerjaan tercepat
        $topFallout = $dataFallout->sortBy('duration_seconds')->take(10);

        return view('dashboardkpi', [
            'request' => $request,
            'totalFallout' => $totalFallout,
            'categories' => $categories,
            'dataFallout' => $dataFallout,
            'topFallout' => $topFallout,
            'falloutStatusChart' => $falloutStatusChart->build()
        ]);
    }


    // function filtertanggal(FalloutStatusChart $falloutStatusChart, Request $request)
    // {   
        
    //     $dataFallout = Fallout::select('order_id','sto','tanggal_fallout','pic','status','ket')
    //                     ->when(
    //                         $request->date_start && $request->date_end,
    //                         function (Builder $builder) use ($request) {
    //                             $builder->whereBetween(
    //                                 DB::raw('DATE(tanggal_fallout)'),
    //                                 [
    //                                     $request->date_start,
    //                                     $request->date_end,
    //                                 ]
    //                             );
    //                         }
    //                     )->paginate(10);

    //     // Variabel berdasarkan status
    //     $falloutPi = Fallout::Where('status','PI (Provision Issues)');
    //     $falloutPs = Fallout::Where('status','PS (Completed)');
    //     $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
    //     $falloutCapul = Fallout::Where('status','Capul / Revoke');

    //     return view('dashboardkpi',[
    //         'request' => $request,
    //         'dataFallout' => $dataFallout,
    //         'falloutStatusChart' => $falloutStatusChart->build(),
    //         'falloutPi' => $falloutPi,
    //         'falloutPs' => $falloutPs,
    //         'falloutEskalasi' => $falloutEskalasi,
    //         'falloutCapul' => $falloutCapul
    //     ]);
    // }

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
            'role' => 'required|string|in:Admin,Division Leader,Unit Leader,Employee',
            'password' => 'required|string|min:6',
        ]);
    
        // Buat akun baru
        $user = User::create([
            'name' => $request->input('name'),
            'id_employee' => $request->input('id_employee'),
            'role'=>$request->input('role'),
            'password' => bcrypt($request->input('password')), // Menggunakan bcrypt untuk menyimpan password secara aman
        ]);
    
        // Jika berhasil, redirect ke halaman tertentu
        return redirect()->route('daftaruser')->with('success', 'Account created successfully.');
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

    public function showKpiDashboard(KecepatanKaryawanChart $chart)
    {
        // Inisialisasi chart
        $chart = $chart->build();

        $dataemployee = User::all(); // Ambil semua data karyawan

        // Hitung total submisi fallout dan kecepatan rata-rata
        foreach ($dataemployee as $employee) {
            $totalSubmisi = Fallout::where('pic', $employee->name)->count();
            $fallouts = Fallout::where('pic', $employee->name)->get();
            $totalDuration = 0;

            foreach ($fallouts as $fallout) {
                $start = strtotime($fallout->created_at);
                $end = strtotime($fallout->end_at);
                $totalDuration += ($end - $start); // Hitung durasi dalam detik
            }

            // Hitung rata-rata kecepatan dalam detik
            $averageDuration = ($totalSubmisi > 0) ? ($totalDuration / $totalSubmisi) : 0;

            // Bulatkan ke dua angka desimal
            $averageDuration = round($averageDuration, 2);

            // Tambahkan informasi ke array data karyawan
            $employee->totalSubmisi = $totalSubmisi;
            $employee->averageDuration = $averageDuration;
        }

        // Filter data karyawan berdasarkan peran
        $dataemployee = $dataemployee->reject(function ($employee) {
            return $employee->role == 'Admin';
        });

        // || $employee->role == 'Division Leader'

        $topEmployees = $dataemployee->sortBy('averageDuration')->take(5);
        
        return view('dashboardkpi2', [
            'dataemployee' => $dataemployee,
            'topEmployees' => $topEmployees,
            'chart' => $chart
        ]);
    }

    function dashboardkpi2_filtertanggal(KecepatanKaryawanChart $chart, Request $request)
    {
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
        $falloutPi = Fallout::Where('status','PI (Provision Issues)');
        $falloutPs = Fallout::Where('status','PS (Completed)');
        $falloutEskalasi = Fallout::Where('status', 'Eskalasi');
        $falloutCapul = Fallout::Where('status','Capul / Revoke');



        return view('dashboardkpi2',[
            'request'=> $request,
            'dataFallout' => $dataFallout,
            'chart'=>$chart->build(),
            'falloutPi' => $falloutPi,
            'falloutPs' => $falloutPs,
            'falloutEskalasi' => $falloutEskalasi,
            'fallout' => $falloutCapul,
        ]);
    }

    function detailkecepatankaryawan(DetailKecepatanKaryawanChart $chart, $id_employee){
        
        $employee = User::where('id_employee', $id_employee)->firstOrFail();
        $totalSubmisi = Fallout::where('pic', $employee->name)->count();
        $dataFallout = Fallout::where('pic', $employee->name)->paginate(10);

        return view('detailkecepatankaryawan',[
            'chart' => $chart->build(), // Build chart sebelum dikirim ke view
            'employee' => $employee,
            'totalSubmisi' => $totalSubmisi,
            'dataFallout' => $dataFallout
        ]);
    }
      
    public function caridatafallout(Request $request) {

        $dataFallout = Fallout::select('order_id','sto','tanggal_fallout','pic','status','ket');

        if ($request->get('search')) {
            $dataFallout = $dataFallout->Where('order_id','LIKE', '%' .$request->get('search').'%')
                                        ->orWhere('pic', 'LIKE', '%' .$request->get('search').'%')
                                        ->orWhere('sto', 'LIKE', '%' .$request->get('search').'%')
                                        ->orWhere('status', 'LIKE', '%' .$request->get('search').'%')
                                        ->orWhere('ket', 'LIKE', '%' .$request->get('search').'%');
        } 
        $dataFallout = $dataFallout->paginate(10);

        return view('/halamanFallout',compact('dataFallout'));
    }

    public function daftaruser_Admin() {

        $dataUser = User::all();

        return view('daftaruser',['dataUser' => $dataUser]);
    }

    public function edituser_Admin($id_employee) {

        $updateUser = User::where('id_employee', $id_employee)->firstOrFail();
        return view('edituser', compact('updateUser'));
    }

    public function updateuser_edituser_Admin(Request $request, $id_employee) {
        // Validasi input
        
        $request->validate([
            'name' => 'required|string|max:255',
            'id_employee' => 'required|string|max:255|unique:users,id_employee,'.$id_employee,
            'role' => 'required|string|in:Division Leader,Unit Leader,Employee',
            'password' => 'nullable|string|min:6',
        ]);
    
        // Temukan user berdasarkan id_employee
        $updateUser = User::where('id_employee', $id_employee)->firstOrFail();

        dd($request->password); // atau var_dump($request->password);

        // Update informasi user
        $updateUser->id_employee = $request->id_employee;
        $updateUser->name = $request->name;
        $updateUser->role = $request->role;
        
        // Update password jika ada input baru
        if($request->password) {
            // Enkripsi password baru
            $updateUser->password = bcrypt($request->password);
        }
    
        // Simpan perubahan
        $updateUser->save();

        return $updateUser;
        // Redirect kembali ke halaman daftar user
        return redirect()->route('daftaruser')->with('success', 'User berhasil diperbarui.');
    }

    public function deleteuser_daftaruser_Admin($id_employee) {

        // Menemukan data Fallout berdasarkan order_id
        $deleteUser = User::where('id_employee', $id_employee)->firstOrFail();

        //Hapus data Fallout dari database
        $deleteUser->delete();

        // Redirect kembali ke halaman Fallout
        return redirect()->route('daftaruser')->with('success', 'Account User Berhasil di Hapus');
    }

    function addfallout()
    {
        $created_at = now()->format('H:i:s');
        session()->put('created_at', $created_at);

        return view('addfallout');
    }

    public function store_addfallout_unitleader(Request $request)
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

    public function editfallout_HalamanFallout($order_id) {
        $updateFallout = Fallout::where('order_id', $order_id)->firstOrFail();
        return view('editfallout', compact('updateFallout'));
    }

    public function updatefallout_HalamanFallout(Request $request, $order_id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'order_id' => 'required|string',
            'status_message' => 'required|string',
            'sto' => 'required|string',
            'status' => 'required|string|in:PS (Completed),PI (Provision Issues),Capul/Revoke,Eskalasi',
            'ket' => 'required|string',
            'ticket' => $request->status == 'Eskalasi' ? ['required', 'string'] : 'nullable|string'
        ]);

        $fallout = Fallout::find($order_id); // Sesuaikan dengan cara Anda mendapatkan data Fallout yang ingin diupdate
        $fallout->order_id = $validatedData['order_id'];
        $fallout->status_message = $validatedData['status_message'];
        $fallout->sto = $validatedData['sto'];
        $fallout->status = $validatedData['status'];
        $fallout->ket = $validatedData['ket'];
        $fallout->ticket = $validatedData['ticket'] ?? ''; // Pastikan ticket diisi hanya jika ada
        $fallout->updated_at = now(); // Set updated_at menjadi waktu saat ini

        // Mengambil nilai end_at yang saat ini ada dalam basis data
        $end_at = $fallout->end_at;

        $fallout->save();

        // Menetapkan kembali nilai end_at setelah menyimpan perubahan
        $fallout->end_at = $end_at;
        $fallout->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('halamanFallout')->with('success', 'Data Fallout berhasil diperbarui!');
    }

    public function deletefallout($order_id) {

        // Menemukan data Fallout berdasarkan order_id
        $deleteFallout = Fallout::where('order_id', $order_id)->firstOrFail();

        //Hapus data Fallout dari database
        $deleteFallout->delete();

        // Redirect kembali ke halaman Fallout
        return redirect()->route('halamanFallout')->with('success', 'Data Fallout Berhasil di Hapus');
    }

    public function export_HalmanFallout_divisionleader() 
    {
        return Excel::download(new FalloutExport, 'DataFallout.xlsx');
    }

}
