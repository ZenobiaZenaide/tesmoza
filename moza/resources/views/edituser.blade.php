<div class="container">
    <x-sidebar />
    <main>
        <div class="back">
            <a href="{{ route('daftaruser')}}">
                <span class="material-icons-sharp">arrow_back_ios</span>
            </a>
            <p>Kembali</p>
        </div>
        <form action="{{ route('store_data_fallout') }}" method="POST" class="formadduser-card">
            @csrf
            <div class="title">
                <h3>Edit User</h3>
            </div>

            <div class="form-fields">
                <div class="profile-picture">
                    <div class="circle"></div>
                </div>
                <div class="fields">
                    <label for="order_id">Order ID: </label>
                    <input type="text" id="order_id" name="order_id" required>
                </div>

                <div class="fields">
                    <label for="status_message">Status Message: </label>
                    <input type="text" id="status_message" name="status_message" required>
                </div>

                <div class="fields">
                    <label for="sto">STO: </label>
                    <input type="text" id="sto" name="sto" required>
                </div>

                <div class="fields">
                    <label for="status">Status: </label>
                    <select id="status" name="status">
                        <option value="PS (Completed)">PS (Completed)</option>
                        <option value="Eskalasi">Eskalasi</option>
                        <option value="PI (Provision Issues)">PI (Provision Issues)</option>
                        <option value="Capul/Revoke">Capul/Revoke</option>
                    </select>
                </div>

                <div class="fields" id="ket_input" style="display: none;">
                    <label for="ket">Keterangan : </label>
                    <input type="text" id="ket" name="ket">
                </div>

                <div class="fields-button">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    </main>
</div>