<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DivisionLeaderController;
use App\Http\Controllers\UnitLeaderController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

// Charts
use App\Http\Charts\FalloutStatusChart;

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

    // Division Leader Access
    // Route::get('/divisionleader',[DivisionLeaderController::class,'divisionleader'])->middleware('userAccess:divisionleader');
    Route::group(['middleware' => ['userAccess:divisionleader']], function () {
        Route::get('/dashboardkpi', [DivisionLeaderController::class, 'dashboardkpi'])->name("dashboardkpi");
        Route::get('/adduser', [DivisionLeaderController::class, 'adduser'])->name("adduser");
        Route::post('/create-account', [DivisionLeaderController::class, 'createAccount'])->name('create.account');
        Route::get('/halamanFallout', [DivisionLeaderController::class, 'halamanFallout'])->name("halamanFallout");
        Route::get('/addfallout', [DivisionLeaderController::class, 'addfallout'])->name("addfallout");
        Route::post('/addfallout', [DivisionLeaderController::class, 'store'])->name("store_data_fallout");
        Route::get('/dashboardkpi2', [DivisionLeaderController::class, 'dashboardkpi2'])->name("dashboardkpi2");
        Route::get('/detailkecepatankaryawan', [DivisionLeaderController::class, 'detailkecepatankaryawan'])->name("detailkecepatankaryawan");
    });

    // Unit Leader Access
    // Route::get('/unitleader',[UnitLeaderController::class,'unitleader'])->middleware('userAccess:unitleader');
    Route::group(['middleware' => ['userAccess:unitleader']], function () {
        Route::get('/unitleader', [UnitLeaderController::class, 'unitleader']);
    });

    // Employee Access
    // Route::get('/employee',[EmployeeController::class,'employee'])->middleware('userAccess:employee');
    Route::group(['middleware' => ['userAccess:employee']], function () {
        Route::get('/employee', [EmployeeController::class, 'employee']);
    });

    //Log Out
    Route::get('/logout',[LoginController::class,'logout']);
});