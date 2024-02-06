

<div class="container">
    <x-sidebar />
    <main>
        {{-- <div class="date">
            <input type="date">
        </div> --}}

        <div class="dashboard-header">
            <div class="dashboard-title">
                <h2>Welcome, Benny! </h2>
            </div>
            <div class="dashboard-switch">
                <a href=" {{route('dashboardkpi2')}}" class="dashboard-btn-switch">Switch</a>
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
        
        <div class="dashboard-body">
            <div class="dashboard-body-right">
                <div class="totalsubmitted-card">
                    <div class="content">
                        <div class="content-left">
                            <p> Total Fallout Telah Tersubmisi </p>
                            <h2> 20 </h2>
                        </div>
                        <div class="content-right">
                            <span class="material-icons-outlined">check_circle </span>
                        </div>
                    </div>
                </div>
                <div class="falloutStatus-Chart">
                    {!! $falloutStatusChart->container() !!}
                </div>
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
        </div>
    </main>
</div>

{{-- Tempat untuk script --}}
<script src="{{ asset('dist/app.js')}}"></script>

<script>
    var selectedStatuses = [];

    // PHP data passed to JavaScript
    var dataFallout = @json($dataFallout);

    // Functions using DOM
    function toggleFilter(status) {
        if (selectedStatuses.includes(status)) {
            // Status is already selected, remove it
            selectedStatuses = selectedStatuses.filter(item => item !== status);
        } else {
            // Status is not selected, add it
            selectedStatuses.push(status);
        }

        // Log the selected statuses (optional)
        console.log('Selected Statuses:', selectedStatuses);

        // Call your filterData function or perform other actions
        filterData(selectedStatuses);
    }

    // Function to filter data based on selected statuses
    function filterData(statuses) {
        // Filter the dummy data based on selected statuses
        const filteredData = dataFallout.filter(data => statuses.includes(data.status));

        // Update the UI with the filtered data
        updateUI(filteredData);
    }

    // Function to update the UI based on filtered data
    function updateUI(data) {
        // Update the table with the filtered data
        const tableBody = document.querySelector('.fallout-table tbody');
        tableBody.innerHTML = '';

        data.forEach(function(item) {
            const row = document.createElement('tr');
            row.innerHTML = `<td>${item.order_id}</td>
                             <td>${item.sto}</td>
                             <td>${item.tanggal_fallout}</td>
                             <td>${item.pic}</td>
                             <td>${item.status}</td>
                             <td>${item.ket}</td>`;

            tableBody.appendChild(row);
        });
    }
</script>

<script src="{{ $falloutStatusChart->cdn() }}"></script>

{{ $falloutStatusChart->script() }}
