<div class="container">
    <x-sidebar />
    <main>
        <div class="back">
            <a href="{{ route('daftaruser')}}">
                <span class="material-icons-sharp">arrow_back_ios</span>
            </a>
            <p>Kembali</p>
        </div>
        <form action="{{ route('updateuser', ['id_employee' => $updateUser->id_employee]) }}" method="POST" class="formadduser-card">
            @csrf
            <div class="title">
                <h3>Edit User</h3>
            </div>

            <div class="form-fields">
                <div class="profile-picture">
                    <div class="circle"></div>
                </div>

                <div class="fields">
                    <label for="id_employee">Employee ID: </label>
                    <input type="text" id="id_employee" name="id_employee" value="{{ $updateUser->id_employee }}" required>
                </div>

                <div class="fields">
                    <label for="name">Nama: </label>
                    <input type="text" id="name" name="name" value="{{ $updateUser->name }}" required>
                </div>

                <div class="fields">
                    <label for="role">Role: </label>
                    <select id="role" name="role">
                        <option value="Division Leader" {{ $updateUser->role == 'Division Leader' ? 'selected' : '' }}>Division Leader</option>
                        <option value="Unit Leader" {{ $updateUser->role == 'Unit Leader' ? 'selected' : '' }}>Unit Leader</option>
                        <option value="Employee" {{ $updateUser->role == 'Employee' ? 'selected' : '' }}>Employee</option>
                        <option value="Admin" {{ $updateUser->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="fields">
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password baru" value="{{ $updateUser }}" required>
                </div>

                <div class="fields-button">
                    <button type="submit">Perbarui User</button>
                </div>
            </div>
        </form>
    </main>
</div>