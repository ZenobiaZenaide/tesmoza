
<div class="container">
<x-sidebar />
    <main>
        <form action="/submit" method="post" class="formadduser-card">
            <div class="title">
                <h3>Tambah Akun DAMAN</h3>
            </div>
            <div class="form-fields">
                {{-- Username --}}
                <div class="fields">
                    <label for="user">Username: </label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="fields">
                    <label for="id">ID Employee: </label>
                    <input type="text" id="id" name="id" required>
                </div>

                <div class="fields">
                    <label for="password">Username: </label>
                    <input type="text" id="password" name="password" required>
                </div>

                <div class="fields">
                    <label for="dropdown">nanti buat dropdown </label>
                    <select id="fruitDropdown">
                        <option value="apple">Apple</option>
                        <option value="banana">Banana</option>
                        <option value="orange">Orange</option>
                        <option value="grape">Grape</option>
                        <option value="strawberry">Strawberry</option>
                    </select>
                </div>

                <div class="fields-button">
                    <button type="/submit">Submit</button>
                </div>
            </div>
        </form>
    <main>
</div>

{{-- Scripts --}}
