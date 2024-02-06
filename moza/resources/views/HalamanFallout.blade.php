
<div class="container">
    <x-sidebar />
        <main>
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
                    <div class="search-bar">
                        <input type="text" id="searchbar" name="searchbar">
                        <span class="material-icons-sharp">search</span>
                    </div>
                    <div class="filter">
                        <p> Export ke Excel</p>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br />
                {{ $dataFallout->links() }}
            </div>
        <main>
    </div>