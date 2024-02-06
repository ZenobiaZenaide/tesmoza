
<div class="container">
    <x-sidebar />
        <main>        
            <div class="fallout-table">
                <div class="table-additions">
                    <form  class="search-bar" action="{{ route('caridatafallout')}}" method="GET">
                            <input type="search" name="search" value="{{ request('search') }}" id="searchbar" name="searchbar">
                            <span class="material-icons-sharp">search</span>
                    </form>
                    <div class="add-items">
                        <a href="{{ route('adduser')}}">
                        <span class="material-icons-sharp">add</span>
                        </a>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th> </th>
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
                            <td><div class="circle-1"> </div></td>
                            <td>{{ $data['sto'] }}</td>
                            <td>{{ $data['tanggal_fallout'] }}</td>
                            <td>{{ $data['pic'] }}</td>
                            <td>{{ $data['status'] }}</td>
                            <td>{{ $data['ket'] }}</td>
                            <td>
                                <a href="{{ route('edituser') }}">
                                    <span class="material-icons-outlined">edit</span>
                                </a>
                                <a href="#">
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