<div class="container">
    <x-sidebar />
    <main>
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h2>Welcome, Benny! </h2>
            </div>
            <div class="dashboard-switch">
                <a href=" {{route('dashboardkpi')}}" class="dashboard-btn-switch">Switch</a>
            </div>
        </div>

        <div class="falloutStatus-Chart">
            {!! $chart->container() !!}
        </div>

        
        <div class="fallout-table">
            <h2>Top 10 Submisi Data Fallout Tercepat</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order_id</th>
                        <th>STO</th>
                        <th>Tanggal Fallout</th>
                        <th>PIC</th>
                        <th>Status</th>
                        <th>KET</th>
                        <th>Aksi</th>
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
                            <a href="{{route('detailkecepatankaryawan')}}">
                            <span class="material-icons-outlined"> visibility </span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br />
            {{ $dataFallout->links() }}
        </div>
    </main>
</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}