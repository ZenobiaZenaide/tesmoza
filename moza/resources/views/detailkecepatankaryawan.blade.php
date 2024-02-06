
<div class="container">
    <x-sidebar />
    <main>
        <div class="back">
            <a href="{{ route('dashboardkpi2')}}">
            <span class="material-icons-sharp">arrow_back_ios</span>
            </a>
            <p>Kembali</p>
        </div>
        
        <div class="detail-container-1">
            <div class="biodata">
                <div class="profile-picture">
                    <div class="circle"></div>
                </div>
                <div class="namakaryawan">
                   <h1>Benny</h1>
                </div>
                <div class="detail-biodata">
                    <div class="biodata-1">
                        <div class="biodata-1-judul">
                            <p>Nama</p>
                        </div>
                        <div class="biodata-1-isi">
                            <div class="titik-dua">
                                :
                            </div>
                            <p>Benny Mister Benny</p>
                        </div>
                    </div>
                    <div class="biodata-1">
                        <div class="biodata-1-judul">
                            <p>Role</p>
                        </div>
                        <div class="biodata-1-isi">
                            <div class="titik-dua">
                                :
                            </div>
                            <p>Unit Leader</p>
                        </div>
                    </div>
                    <div class="biodata-1">
                        <div class="biodata-1-judul">
                            <p>Employee ID</p>
                        </div>
                        <div class="biodata-1-isi">
                            <div class="titik-dua">
                                :
                            </div>
                            <p>123456</p>
                        </div>
                    </div>
                    <div class="biodata-1">
                        <div class="biodata-1-judul">
                            <p>Total Submisi Fallout</p>
                        </div>
                        <div class="biodata-1-isi">
                            <div class="titik-dua">
                                :
                            </div>
                            <p>100 Fallout</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kecepatankaryawan-linechart">
                {!! $chart->container() !!}
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
    </main>
</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}