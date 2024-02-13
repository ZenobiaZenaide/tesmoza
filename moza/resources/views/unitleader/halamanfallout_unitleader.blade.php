<div class="container">
    <x-sidebar />
    <main>
        <div class="dashboard-header">
            <div class="dashboard-title">
                <div class="profile-picture">
                    <div class="circle">
                        
                    </div>
               </div>
               <p> Welcome, Benny! Si Unit Leader</p>
            </div>
            <div class="header-content">
                <form action={{ route('filtertanggal_halamanfallout_unitleader')}} method="get" class="periode">
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
                            <a href="{{route('halamanfallout_unitleader')}}" class="submit-date" >Reset</a>
                            <span class="material-icons-sharp marginmanual-restart_alt-dashboardfallout_unitleader">restart_alt</span>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="line-break">
            </div>
        </div> 
        <div class="table-additions2">
            <div class="title-left">
                Data Fallout
            </div>
            <div class="additions-right">
                <div class="search">
                    <form class="search-bar" action="{{route('caridatafallout_halamanfallout_unitleader')}}" method="GET">
                        <input type="search" name="search" value="{{ request('search')}}" id="search">
                        <span class="material-icons-sharp">search</span>
                    </form>
                </div>
                <div class="add-items">
                    <a href="{{route('addfallout_unitleader')}}">
                        <span class="material-icons-sharp">add</span>
                    </a>  
                </div>
            </div>
        </div>
        <div class="body-container">
                <div class="fallout-table">
                    <div class="table-additions2 marginmanual-titletable-halamanfallout_unitleader">
                        <div class="title-table ubahwarna-title-table-halamanfallout_unitleader">
                            Fallout Eskalasi <span class="ubahwarna-span-title-table-halamanfallout_leader"> - belum ada keterangan </span>
                        </div>
                        <div class="add-ons">

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
                                    <a href="#">
                                        <span class="material-icons-outlined ubahwarna-add-halamanfallout_unitleader">playlist_add</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br />
                    {{ $dataFallout->links() }}
                </div>
                <div class="fallout-table">
                    <div class="table-additions2 marginmanual-titletable-halamanfallout_unitleader">
                        <div class="title-table ubahwarna-title-table-halamanfallout_unitleader">
                            Semua Submisi Fallout
                        </div>
                        <div class="add-ons">

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
        </div>
    </main>
</div>