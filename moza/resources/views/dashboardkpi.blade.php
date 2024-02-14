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
                <form action={{ route('filtertanggal')}} method="get" class="periode">
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
                    </div>
                </form>
                <div class="dashboard-switch">
                    <div class="switch">
                        <a href=" {{route('dashboardkpi2')}}" class="dashboard-btn-switch">Switch To KPI</a>
                        <span class="material-icons-outlined">arrow_forward_ios</span>
                    </div>
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
                        <h1>{{ $categories['PS (Completed)'] }}</h1>
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
                        <h1>{{ $categories['PI (Provision Issues)'] }}</h1>
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
                        <h1>{{ $categories['Eskalasi'] }}</h1>
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
                        <h1>{{ $categories['Capul / Revoke'] }}</h1>
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
                            <h2>{{ $totalFallout }}</h2>
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

{{-- Tempat untuk script --}}
<script src="{{ asset('dist/app.js')}}"></script>
{{-- 
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
</script> --}}

<script src="{{ $falloutStatusChart->cdn() }}"></script>

{{ $falloutStatusChart->script() }}
