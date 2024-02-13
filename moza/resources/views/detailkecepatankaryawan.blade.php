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
                   <h1>{{ $employee->name }}</h1>
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
                            <p>{{ $employee->name }}</p>
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
                            <p>{{ $employee->role }}</p>
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
                            <p>{{ $employee->id_employee }}</p>
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
                            <p>{{ $totalSubmisi }} Fallout</p>
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
                @foreach ($dataFallout as $fallout)
                    <tr>
                        <td>{{ $fallout->order_id }}</td>
                        <td>{{ $fallout->sto }}</td>
                        <td>{{ $fallout->tanggal_fallout }}</td>
                        <td>{{ $fallout->pic }}</td>
                        <td>{{ $fallout->status }}</td>
                        <td>{{ $fallout->ket }}</td>
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