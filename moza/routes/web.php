<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DivisionLeaderController;
use App\Http\Controllers\UnitLeaderController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/divisionleader');
});

Route::middleware(['auth'])->group(function() {

    // Division Leader Access
    // Route::get('/divisionleader',[DivisionLeaderController::class,'divisionleader'])->middleware('userAccess:divisionleader');
    Route::group(['middleware' => ['userAccess:divisionleader']], function () {
        Route::get('/divisionleader', [DivisionLeaderController::class, 'divisionleader']);
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