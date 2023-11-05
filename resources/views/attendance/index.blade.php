@extends('layouts.master')
@section('master.header')
     <!-- App Header -->
     <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Presensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <input type="hidden" id="lokasi">
            <div id="my_camera"></div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            @if ($isAttend > 0)
                <button id="btn-check-in" class="btn btn-danger btn-block">Absen Pulang</button>
            @else
                <button id="btn-check-in" class="btn btn-primary btn-block">Absen Masuk</button>
            @endif
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
@endsection
@push('webcam-script')
<script language="JavaScript">
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90,
    });
    
    Webcam.attach('#my_camera');

    let lokasi = document.getElementById('lokasi');

    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation, errLocation)
    }

    function showLocation(position) {
        lokasi.value = position.coords.latitude + "," + position.coords.longitude;
        let map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);
        
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        let marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
    }

    function errLocation() {}

    $("#btn-check-in").click(function(e) {
        Webcam.snap(function(data_uri) {
            image = data_uri;
        });
        let location = $("#lokasi").val();
        $.ajax({
            type: 'POST',
            url: '/presensi/store',
            data: {
                _token: "{{ csrf_token() }}",
                image: image,
                location: location,
            },
            success: function(response) {
                let status = response.split('|');
                
                if(status[0] === 'success') {
                    Swal.fire({
                    title: 'Berhasil!',
                    text: status[1],
                    icon: 'success',
                });
                setTimeout("location.href='/dashboard'", 3000);
                } else {
                    Swal.fire({
                    title: 'Error!',
                    text: status[1],
                    icon: 'error',
                });
                }
            }
        })
    });

</script>
@endpush