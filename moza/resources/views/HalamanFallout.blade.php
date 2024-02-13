
<div class="container">
    <x-sidebar />
        <main>
            <div class="dashboard-header">
                <div class="dashboard-title">
                    <div class="profile-picture">
                        <div class="circle">
                            
                        </div>
                   </div>
                   <p> Welcome, Benny!</p>
                </div>
                <div class="header-content">
                    <div class="periode">
                        <div class="date">
                            <label for="date-start">Mulai : </label>
                            <input type="date" id="date-start" name="date-start">
                        </div>
                        <div class="date">
                            <label for="date-end">Berakhir : </label>
                            <input type="date" id="date-end" name="date-end">
                        </div>
                    </div>
                    <div class="spacing">
                       
                    </div>
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
                            <h3>PS (Complete)</h3>
                            <h1>11</h1>
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
                            <h3>PI (Provision Issues)</h3>
                            <h1>13</h1>
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
                            <h3>Eskalasi</h3>
                            <h1>20</h1>
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
                            <h3>Capul / Revoke</h3>
                            <h1>50</h1>
                        </div>
                        <div class="progress">
                            <span class="material-icons-sharp">bar_chart</span>
                        </div>
                    </div>
                    <small class="text-muted">Fallout</small>
                </div>
            </div>
    
            <div class="fallout-table">
                <div class="table-additions">
                    <form class="search-bar" action="{{ route('caridatafallout')}}" method="GET">
                            <input type="search" name="search" value="{{ request('search') }}" id="searchbar" name="searchbar">
                            <span class="material-icons-sharp">search</span>
                    </form>
                    <div class="filter">
                        <a href="{{ route('fallout.exportExcel') }}">Export ke Excel</a>
                        <span class="material-icons-sharp">save_as</span>
                    </div>
                    <div class="add-items">
                        <a href="{{ route('addfallout')}}">
                        <span class="material-icons-sharp">add</span>
                        </a>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order_id</th>
                            <th>STO</th>
                            <th>Tanggal Fallout</th>
                            <th>PIC</th>
                            <th>Status</th>
                            <th>KET</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($dataFallout as $data)
                        <tr>
                            <td>{{ $data['order_id'] }}</td>
                            <td>{{ $data['sto'] }}</td>
                            <td>{{ $data['tanggal_fallout'] }}</td>
                            <td>{{ $data['pic'] }}</td>
                            <td>{{ $data['status'] }}</td>
                            <td>{{ $data['ket'] }}</td>
                            <td>
                                <a href="{{ route('editfallout', ['order_id' => $data->order_id]) }}">
                                    <span class="material-icons-outlined">edit</span>
                                </a>
                                <a href="{{ route('fallout.delete', ['order_id' => $data->order_id]) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <span class="material-icons-outlined">delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br />
                {{ $dataFallout->links() }}
            </div>
        <main>
    </div>