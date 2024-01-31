<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionLeaderController extends Controller
{
    function divisionleader()
    {
        // Penanda

        // echo "Halo, Selamat Datang Mr Division Leader";
        // echo "<h1>" . Auth::user()->name . "</h1>";
        // echo "<a href='logout'>Logout >></a>";

        return view('dashboardkpi');

    }

    function adduser()
    {
        return view('adduser');
    }
}
