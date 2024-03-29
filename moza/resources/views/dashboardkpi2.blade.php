<div class="container">
    <x-sidebar />
    <main>
        <div class="dashboard-header">
            <div class="dashboard-title">
                <div class="profile-picture">
                    <div class="circle">
                        
                    </div>
               </div>
               <p> Welcome, Benny! </p>
            </div>
            <div class="header-content">
                <form action={{ route('dashboardkpi2_filtertanggal')}} method="get" class="periode">
                    <div class="date">
                        <label for="date-start">Mulai : </label>
                        <input type="date" id="date_start" name="date_start" value="{{ request('date_start') }}">
                    </div>
                    <div class="date">
                        <label for="date-end">Berakhir : </label>
                        <input type="date" id="date_end" name="date_end" value="{{ request('date_end') }}">
                    </div>
                    <div class="spacing">
                        <div class="filter-date">
                            <button class="submit-date" id="submit" value="search">Filter</button>
                        </div>
                        <div class="filter-date marginmanual-filter-date-dashboardfallout_unitleader">
                            <a href="{{route('dashboardkpi')}}" class="submit-date" >Reset</a>
                            <span class="material-icons-sharp marginmanual-restart_alt-dashboardfallout_unitleader">restart_alt</span>
                        </div>
                    </div>
                    
                </form>
                <div class="dashboard-switch">
                    <div class="switch">
                        <a href=" {{route('dashboardkpi')}}" class="dashboard-btn-switch">Switch To Fallout</a>
                        <span class="material-icons-outlined">arrow_forward_ios</span>
                    </div>
                </div>
            </div>
            <div class="line-break">
                
            </div>
        </div>

        <div class="body-container-dashboardkpi2">
            <div class="falloutStatus-Chart2">
                {!! $chart->container() !!}
            </div>
                <div class="fallout-table" style="margin-top: 1rem;">
                        <h2 class="ubahwarna-h2-fallout-table-dashboard_fallout_unitleader">Top 5 Karyawan Tercepat</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Nama</th>
                                <th>Total Submisi Fallout</th>
                                <th>Kecepatan Rata - Rata</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($topEmployees as $employee)
                            <tr>
                                <td>{{ $employee->id_employee }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->totalSubmisi }}</td>
                                <td>{{ $employee->averageDuration  }} seconds</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br />
                    {{-- {{ $dataFallout->links() }} --}}
                </div>
        </div>

        
        <div class="fallout-table">
            <div class="table-additions">
                <form class="search-bar" action="#" method="GET">
                        <input type="search" name="search" value="#" id="searchbar" name="searchbar">
                        <span class="material-icons-sharp">search</span>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Nama</th>
                        <th>Total Submisi Fallout</th>
                        <th>Kecepatan Rata - Rata</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($dataemployee as $data)
                    <tr>
                        <td>{{ $data->id_employee }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->totalSubmisi }}</td>
                        <td>{{ $data->averageDuration }} seconds</td>
                        <td>
                            <a href="{{ route('detailkecepatankaryawan', ['id_employee' => $data->id_employee]) }}">
                            <span class="material-icons-outlined"> visibility </span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br />
            {{-- {{ $dataFallout->links() }} --}}
        </div>
    </main>
</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}