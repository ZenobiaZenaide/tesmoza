<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitLeaderController extends Controller
{
    function unitleader()
    {
        echo "Halo, Selamat Datang Mr Unit Leader";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='logout'>Logout >></a>";
    }
}
