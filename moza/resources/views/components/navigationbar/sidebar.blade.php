@extends('layout.header')
@section('content')
<div class="container">
    <aside class="fixed h-full overflow-y-auto">
        <div class="top">
            <div class="logo">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiHLfFbAIscmuo21OPZRS2fM01J4Exq5r-ZrWsUREKprTi9fVypwsrHypkdI_-MolpWJdFh0FA9_2dKDsb9jO_i2fIkypZ_2uNLhQrgmNKu0NLq3JLhbSrruhWPxovKZcuvMPJTaVvF0J7gnCgKmAFXpz0wutel8Kq5c684pJrhknnGXF1spFjB8eoPKw/s1648/Telkomsel_2021_icon.svg.png" alt="telkomlogo">
                <h2 class="text-muted">MO <span class="danger">ZA</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        {{-- Konten Sidebar --}}
        <div class="sidebar">


            {{-- Sidebar Khusus Division Leader --}}
            @if(Auth::user()->role == 'Division Leader')
            <a href="{{ route('dashboardkpi')}}" class="active">
                <span class="material-icons-sharp">dashboard</span>    
                <h3>Dashboard</h3>
            </a>
            <a href="{{ route('halamanFallout')}}">
                <span class="material-icons-sharp">description</span>
                <h3>Data Fallout</h3>
            </a>
            <hr />
            <a href="{{ route('daftaruser')}}">
                <span class="material-icons-sharp">person</span>
                <h3>Manage User</h3>
            </a>
            @endif


            {{-- Sidebar Khusus UnitLeader --}}
            @if(Auth::user()->role == 'unitleader')
            <a href="{{ route('dashboardfallout_unitleader')}}" class="active">
                <span class="material-icons-sharp">dashboard</span>    
                <h3>Dashboard</h3>
            <a href="{{ route('halamanfallout_unitleader')}}">
                 <span class="material-icons-sharp">description</span>
                <h3>Data Fallout</h3>
            </a>

            </a>
            @endif
            <a href="logout">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
    </aside>
</div>

