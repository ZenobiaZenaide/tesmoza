<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisionLeaderController;
use App\Http\Controllers\UnitLeaderController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection; 

// Charts
use App\Http\Charts\FalloutStatusChart;
use App\Http\Charts\FalloutStatusChart_unitleader;
use App\Http\Charts\filtertanggal_FalloutStatusChartUnitLeader;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/',[LoginController::class,'index'])->name('login');
    Route::post('/',[LoginController::class,'login']);
});

Route::get('/home', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function() {

    Route::group(['middleware' => ['userAccess:Admin']], function () {
        Route::get('/admin', [AdminController::class, 'admin']);
    });

    // Division Leader Access
    // Route::get('/divisionleader',[DivisionLeaderController::class,'divisionleader'])->middleware('userAccess:divisionleader');
    Route::group(['middleware' => ['userAccess:Division Leader']], function () {
        Route::get('/dashboardkpi', [DivisionLeaderController::class, 'dashboardkpi'])->name("dashboardkpi");
        Route::get('/adduser', [DivisionLeaderController::class, 'adduser'])->name("adduser");
        Route::post('/create-account', [DivisionLeaderController::class, 'createAccount'])->name('create.account');

        // Halaman Fallout
        Route::get('/halamanFallout', [DivisionLeaderController::class, 'halamanFallout'])->name("halamanFallout");
        Route::get('/addfallout', [DivisionLeaderController::class, 'addfallout'])->name("addfallout");
        Route::post('/addfallout', [DivisionLeaderController::class, 'store_addfallout_unitleader'])->name("store_data_fallout");
        Route::get('/fallout/{order_id}/edit', [DivisionLeaderController::class, 'editfallout_HalamanFallout'])->name("editfallout");
        Route::post('/fallout/update/{order_id}', [DivisionLeaderController::class, 'updatefallout_HalamanFallout'])->name('update_fallout');
        Route::get('/fallout/delete/{order_id}', [DivisionLeaderController::class, 'deletefallout'])->name('fallout.delete');
        Route::get('/caridatafallout', [DivisionLeaderController::class, 'caridatafallout'])->name("caridatafallout");
        Route::get('/export', [DivisionLeaderController::class, 'export_HalmanFallout_divisionleader'])->name('fallout.exportExcel');

        // Halaman User
        Route::get('/daftaruser', [DivisionLeaderController::class, 'daftaruser_Admin'])->name("daftaruser");
        Route::get('/edituser/{id_employee}', [DivisionLeaderController::class, 'edituser_Admin'])->name('edituser');
        Route::post('/{id_employee}/updateuser', [DivisionLeaderController::class, 'updateuser_edituser_Admin'])->name('updateuser');
        Route::get('/user/delete/{id_employee}', [DivisionLeaderController::class, 'deleteuser_daftaruser_Admin'])->name('user.delete');
        
        Route::get('/filtertanggal', [DivisionLeaderController::class, 'filtertanggal'])->name("filtertanggal");
        Route::get('/dashboardkpi2_filtertanggal', [DivisionLeaderController::class, 'dashboardkpi2_filtertanggal'])->name("dashboardkpi2_filtertanggal");
        Route::get('/halamanfallouteskalasi', [DivisionLeaderController::class, 'halamanfallouteskalasi'])->name("halamanfallouteskalasi");
        Route::get('/halamanfallouteskalasi', [DivisionLeaderController::class, 'halamanfallouteskalasi'])->name("halamanfallouteskalasi");
        Route::get('/dashboardkpi2_filtertanggal', [DivisionLeaderController::class, 'dashboardkpi2_filtertanggal'])->name("dashboardkpi2_filtertanggal");
        Route::get('/dashboardkpi2', [DivisionLeaderController::class, 'showKpiDashboard'])->name('dashboardkpi2');
        Route::get('/detailkecepatankaryawan/{id_employee}', [DivisionLeaderController::class, 'detailkecepatankaryawan'])->name('detailkecepatankaryawan');
    });

    // Unit Leader Access
    // Route::get('/unitleader',[UnitLeaderController::class,'unitleader'])->middleware('userAccess:unitleader');
    Route::group(['middleware' => ['userAccess:Unit Leader']], function () {
        Route::get('/unitleader.dashboardfallout_unitleader', [UnitLeaderController::class, 'dashboardfallout_unitleader'])->name("dashboardfallout_unitleader");
        Route::get('/filtertanggal_dashboardfallout_unitleader', [UnitLeaderController::class, 'filtertanggal_dashboardfallout_unitleader'])->name("filtertanggal_dashboardfallout_unitleader");
        Route::get('/halamanfallout_unitleader', [UnitLeaderController::class, 'halamanfallout_unitleader'])->name("halamanfallout_unitleader");
        Route::get('/addfallout_unitleader', [UnitLeaderController::class, 'addfallout_unitleader'])->name("addfallout_unitleader");
        Route::get('/filtertanggal_halamanfallout_unitleader', [UnitLeaderController::class, 'filtertanggal_halamanfallout_unitleader'])->name("filtertanggal_halamanfallout_unitleader");
        Route::get('/caridatafallout_halamanfallout_unitleader', [UnitLeaderController::class, 'caridatafallout_halamanfallout_unitleader'])->name("caridatafallout_halamanfallout_unitleader");
    });

    // Employee Access
    // Route::get('/employee',[EmployeeController::class,'employee'])->middleware('userAccess:employee');
    Route::group(['middleware' => ['userAccess:Employee']], function () {
        Route::get('/employee', [EmployeeController::class, 'employee']);
        Route::get('/dahsboardfallout_employee', [EmployeeController::class, 'dashboardfallout_employee']);
        Route::get('/dahsboardfallout_employee', [EmployeeController::class, 'dashboardfallout_employee']);
    });

    //Log Out
    Route::get('/logout',[LoginController::class,'logout']);
});