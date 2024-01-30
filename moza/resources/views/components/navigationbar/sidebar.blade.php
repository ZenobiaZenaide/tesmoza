@extends('layout.header')
@section('content')
<div class="container">
    <aside>
        <div class="top">
            <div class="logo">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiHLfFbAIscmuo21OPZRS2fM01J4Exq5r-ZrWsUREKprTi9fVypwsrHypkdI_-MolpWJdFh0FA9_2dKDsb9jO_i2fIkypZ_2uNLhQrgmNKu0NLq3JLhbSrruhWPxovKZcuvMPJTaVvF0J7gnCgKmAFXpz0wutel8Kq5c684pJrhknnGXF1spFjB8eoPKw/s1648/Telkomsel_2021_icon.svg.png" alt="telkomlogo">
                <h2>MO <span class="danger">ZA</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        {{-- Konten Sidebar --}}
        <div class="sidebar">
            <a href="#">
                <span class="material-icons-sharp">dashboard</span>    
                <h3>Dashboard</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">description</span>
                <h3>Data Fallout</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">description</span>
                <h3>Rekap data Fallout</h3>
            </a>
            <hr />
            <a href="#">
                <span class="material-symbols-sharp">person</span>
                <h3>Daftar User</h3>
            </a>
            <a href="#">
                <span class="material-symbols-sharp">person</span>
                <h3>Daftar User</h3>
            </a>
        </div>
        

    </aside>

</div>
    
@endsection