<div class="container">
    <x-sidebar />
    <main>
        <div class="dashboard-header">
            <div class="dashboard-title">
                <div class="profile-picture">
                    <div class="circle">
                        
                    </div>
               </div>
               <p> Welcome, Benny! Si Unit Leader </p>
            </div>
            <div class="header-content">
                <form action={{ route('filtertanggal_dashboardfallout_unitleader')}} method="get" class="periode">
                    <div class="date">
                        <label for="date-start">Mulai : </label>
                        <input type="date" id="date_start" name="date_start" value="{{ request('date_stath') }}">
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
                            <a href="{{route('dashboardfallout_unitleader')}}" class="submit-date" >Reset</a>
                            <span class="material-icons-sharp marginmanual-restart_alt-dashboardfallout_unitleader">restart_alt</span>
                        </div>
                    </div>
                    
                </form>
                <div class="dashboard-switch">
                    
                </div>
            </div>
            <div class="line-break">

            </div>
        </div>
        
        <div class="insights">
            <div class="sales"  onclick="toggleFilter('PS (Complete)')">
                <div class="middle">
                    <div class="left">
                        <h3 class="ubahwarna-h3-left-dashboardfallout_unitleader">PS (Completed)</h3>
                        <h1 class="ubahwarna-h2-content-left-dashboardfallout_unitleader">{{ $categories['PS (Completed)'] }}</h1>
                    </div>
                    <div class="progress">
                        <span class="material-icons-sharp">bar_chart</span>
                    </div>
                </div>
                <small class="text-muted">Fallout</small>
            </div>

            <div class="sales" data-status="PI (Provision Issues)" onclick="toggleFilter('PI (Provision Issues)')">
                <div class="middle">
                    <div class="left">
                        <h3 class="ubahwarna-h3-left-dashboardfallout_unitleader">PI (Provision Issues)</h3>
                        <h1 class="ubahwarna-h2-content-left-dashboardfallout_unitleader">{{ $categories['PI (Provision Issues)'] }}</h1>
                    </div>
                    <div class="progress">
                        <span class="material-icons-sharp">bar_chart</span>
                    </div>
                </div>
                <small class="text-muted">Fallout</small>
            </div>

            <div class="sales"  onclick="toggleFilter('Eskalasi')">
                <div class="middle">
                    <div class="left">
                        <h3 class="ubahwarna-h3-left-dashboardfallout_unitleader">Eskalasi</h3>
                        <h1 class="ubahwarna-h2-content-left-dashboardfallout_unitleader">{{ $categories['Eskalasi'] }}</h1>
                    </div>
                    <div class="progress">
                        <span class="material-icons-sharp">bar_chart</span>
                    </div>
                </div>
                <small class="text-muted">Fallout</small>
            </div>

            <div class="sales"  onclick="toggleFilter('Capul / Revoke')">
                <div class="middle">
                    <div class="left">
                        <h3 class="ubahwarna-h3-left-dashboardfallout_unitleader">Capul / Revoke</h3>
                        <h1 class="ubahwarna-h2-content-left-dashboardfallout_unitleader">{{ $categories['Capul / Revoke'] }}</h1>
                    </div>
                    <div class="progress">
                        <span class="material-icons-sharp">bar_chart</span>
                    </div>
                </div>
                <small class="text-muted">Fallout</small>
            </div>
        </div>
        
        <div class="dashboard-body">
            <div class="dashboard-body-right">
                <div class="totalsubmitted-card">
                    <div class="content">
                        <div class="content-left">
                            <p class="ubahwarna-p-content-left-dashboardfallout_unitleader"> Total Fallout Telah Tersubmisi </p>
                            <h2 class="ubahwarna-h2-content-left-dashboardfallout_unitleader">{{ $totalFallout }}</h2>
                        </div>
                        <div class="content-right">
                            <span class="material-icons-outlined">check_circle </span>
                        </div>
                    </div>
                </div>
                <div class="falloutStatus-Chart">
                    {!! $falloutStatusChartUnitLeader->container() !!}
                </div>
            </div>

            <div class="fallout-table">
                <h2 class="ubahwarna-h2-fallout-table-dashboard_fallout_unitleader">Top 10 Submisi Data Fallout Tercepat</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Order_id</th>
                            <th>STO</th>
                            <th>Tanggal</th>
                            <th>PIC</th>
                            <th>Status</th>
                            <th>KET</th>
                            <th>Durasi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($topFallout as $fallout)
                        <tr>
                            <td>{{ $fallout->order_id }}</td>
                            <td>{{ $fallout->sto }}</td>
                            <td>{{ $fallout->tanggal_fallout }}</td>
                            <td>{{ $fallout->pic }}</td>
                            <td>{{ $fallout->status }}</td>
                            <td>{{ $fallout->ket }}</td>
                            <td>{{ $fallout->duration_seconds }} detik</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br />
                {{-- {{ $dataFallout->links() }} --}}
            </div>
        </div>
    </main>
</div>

{{-- Tempat menyimpan java script --}}

<script src="{{ $falloutStatusChartUnitLeader->cdn() }}"></script>

{{ $falloutStatusChartUnitLeader->script() }}
