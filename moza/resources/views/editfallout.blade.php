<div class="container">
    <x-sidebar />
    <main>
        <div class="back">
            <a href="{{ route('halamanFallout')}}">
                <span class="material-icons-sharp">arrow_back_ios</span>
            </a>
            <p>Kembali</p>
        </div>
        <form action="{{ route('update_fallout', ['order_id' => $updateFallout->order_id]) }}" method="POST" class="formadduser-card">
            @csrf
            <div class="title">
                <h3>Edit Data Fallout</h3>
            </div>

            <div class="form-fields">
                <div class="fields">
                    <label for="order_id">Order ID: </label>
                    <input type="text" id="order_id" name="order_id" value="{{ $updateFallout->order_id }}" required>
                </div>

                <div class="fields">
                    <label for="status_message">Status Message: </label>
                    <input type="text" id="status_message" name="status_message" value="{{ $updateFallout->status_message }}" required>
                </div>

                <div class="fields">
                    <label for="sto">STO: </label>
                    <input type="text" id="sto" name="sto" value="{{ $updateFallout->sto }}" required>
                </div>

                <div class="fields">
                    <label for="status">Status: </label>
                    <select id="status" name="status">
                        <option value="PS (Completed)" {{ $updateFallout->status == 'PS (Completed)' ? 'selected' : '' }}>PS (Completed)</option>
                        <option value="Eskalasi" {{ $updateFallout->status == 'Eskalasi' ? 'selected' : '' }}>Eskalasi</option>
                        <option value="PI (Provision Issues)" {{ $updateFallout->status == 'PI (Provision Issues)' ? 'selected' : '' }}>PI (Provision Issues)</option>
                        <option value="Capul/Revoke" {{ $updateFallout->status == 'Capul/Revoke' ? 'selected' : '' }}>Capul/Revoke</option>
                    </select>
                </div>

                <div class="fields" id="ket_input">
                    <label for="ket">Keterangan : </label>
                    <input type="text" id="ket" name="ket" value="{{ $updateFallout->ket }}">
                </div>
                
                <div class="fields" id="ticket_input" style="display: none;">
                    <label for="ticket">Ticket : </label>
                    <input type="text" id="ticket" name="ticket" value="{{ $updateFallout->ticket }}">
                </div>                

                <div class="fields-button">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var statusDropdown = document.getElementById("status");
        var ticketInput = document.getElementById("ticket_input");

        statusDropdown.addEventListener("change", function() {
            if (statusDropdown.value === "Eskalasi") {
                ticketInput.style.display = "block";
            } else {
                ticketInput.style.display = "none";
            }
        });

        // Set initial visibility based on selected status
        if (statusDropdown.value === "Eskalasi") {
            ticketInput.style.display = "block";
        } else {
            ticketInput.style.display = "none";
        }
    });
</script>