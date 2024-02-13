<div class="fallout-table">
    <div class="table-additions">
        <form class="search-bar" action="{{ route('caridatafallout')}}" method="GET">
                <input type="search" name="search" value="{{ request('search') }}" id="searchbar" name="searchbar">
                <span class="material-icons-sharp">search</span>
        </form>
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
                    <a href="{{ route('editfallout') }}">
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