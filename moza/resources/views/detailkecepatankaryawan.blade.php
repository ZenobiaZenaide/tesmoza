
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
                </div>
                <div class="namakaryawan">
                    tes
                </div>
                <div class="employee-id">
                    tes
                </div>
            </div>
            <div class="kecepatankaryawan-linechart">
                {!! $chart->container() !!}
            </div>
        </div>
    </main>
</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}