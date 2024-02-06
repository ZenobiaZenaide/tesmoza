
<div class="container">
    <x-sidebar />
        <main>
            <div class="back">
                <a href="{{ route('halamanFallout')}}">
                <span class="material-icons-sharp">arrow_back_ios</span>
                </a>
                <p>Kembali</p>
            </div>
            <form action="/submit" method="post" class="formadduser-card">
                <div class="title">
                    <h3>Tambah Data Fallout</h3>
                </div>

                <div class="button-start-stop">
                    <button class="start" >Mulai</button>
                    <button class="stop" >Selesai</button> 
                </div>
                <div class="form-fields">
                    {{-- Username --}}
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
                        <label for="ket">Keterangan : </label>
                        <input type="text" id="ket" name="ket" required>
                    </div>

                    <div class="fields">
                        <label for="pic">PIC : </label>
                        <input type="text" id="pic" name="pic" required>
                    </div>
    
                    <div class="fields">
                        <label for="status">nanti buat dropdown </label>
                        <select id="fruitDropdown">
                            <option value="Eskalasi">Eskalasi</option>
                            <option value="PI (Provision Issues)">PI (Provission Issue)</option>
                            <option value="PS (Completed)">PS (Completed)</option>
                            <option value="Capul / Revoke">Capul / Revoke</option>
                        </select>
                    </div>
    
                    <div class="fields-button">
                        <button type="submit" >Submit</button>
                    </div>
                </div>
            </form>
        <main>
    </div>