
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
                            <th></th>
                            <th>ID Employee</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($dataUser as $data)
                        <tr>
                            <td><div class="circle-1"> </div></td>
                            <td>{{ $data['id_employee'] }}</td>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['role'] }}</td>
                            <td class="aksi">
                                <a href="{{ route('edituser', ['id_employee' => $data->id_employee]) }}">
                                    <span class="material-icons-outlined">edit</span>
                                </a>
                                <a href="{{ route('user.delete', ['id_employee' => $data->id_employee]) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    <span class="material-icons-outlined">delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br />
                {{-- {{ $dataUser->links() }} --}}
            </div>
        <main>
    </div>