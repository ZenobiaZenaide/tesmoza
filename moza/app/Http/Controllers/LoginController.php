<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index () 
    {
        return view('login');
    }

    function login(Request $request) 
    {
        $request->validate([
            'id_employee' => 'required',
            'password' => 'required'
        ], [
            'id_employee.required' => 'ID Employee must be filled in',
            'password.required' => 'Password must be filled in',
        ]);

        $infologin = [
            'id_employee' => $request->id_employee,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)){
            if (Auth::user()->role == 'divisionleader') {
                return redirect('divisionleader');
            } elseif (Auth::user()->role == 'unitleader') {
                return redirect('unitleader');
            } elseif (Auth::user()->role == 'employee') {
                return redirect('employee');
            }
        }else{
            return redirect('')->withErrors('Username or Password Incorrect')->withInput();
        }
    }

    function logout() 
    {
        Auth::logout();
        return redirect('');
    }
}
