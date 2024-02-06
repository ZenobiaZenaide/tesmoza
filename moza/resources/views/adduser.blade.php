
<div class="container">
<x-sidebar />
    <main>
        <form action="{{ route('create.account') }}" method="POST" class="formadduser-card">
            @csrf
            
            <div class="title">
                <h3>Tambah Akun DAMAN</h3>
            </div>
            <div class="form-fields">
                {{-- Name --}}
                <div class="fields">
                    <label for="name">Name: </label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="fields">
                    <label for="id_employee">ID Employee: </label>
                    <input type="text" id="id_employee" name="id_employee" required>
                </div>

                <div class="fields">
<<<<<<< HEAD
                    <label for="password">Username: </label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="fields">
                    <label for="dropdown">nanti buat dropdown </label>
                    <select id="fruitDropdown">
                        <option value="apple">Apple</option>
                        <option value="banana">Banana</option>
                        <option value="orange">Orange</option>
                        <option value="grape">Grape</option>
                        <option value="strawberry">Strawberry</option>
=======
                    <label for="role">nanti buat dropdown </label>
                    <select id="role" name="role">
                        <option value="Division Leader">Division Leader</option>
                        <option value="Unit Leader">Unit Leader</option>
                        <option value="Employee">Employee</option>
>>>>>>> 5af6916039222d223a1a54bc64725dd991428b35
                    </select>
                </div>

                <div class="fields">
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="fields-button">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    <main>
</div>

{{-- Scripts --}}
