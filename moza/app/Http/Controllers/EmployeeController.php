<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    function employee()
    {
        echo "Halo, Selamat Datang Mr Employee";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>Logout >></a>";
    }
}
