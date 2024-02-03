<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fallout;

class DivisionLeaderController extends Controller
{
    function dashboardkpi()
    {
        $dataFallout = Fallout::all();

        return view('dashboardkpi',compact('dataFallout'));

    }

    function adduser()
    {
        return view('adduser');
    }
}
