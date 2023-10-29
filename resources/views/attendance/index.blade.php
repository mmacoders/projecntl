@extends('layouts.master')
@section('header')
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
            <button id="btn-absensi-in" class="btn btn-primary btn-block">Absen Masuk</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
@endsection
@push('script-webcam')
<script>
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
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map).bindPopup("<b>Lokasimu saat ini</b>");
    }

    function errLocation() {}

    $("#btn-absensi-in").click(function(e) {
        Webcam.snap(function(data_uri) {
            image = data_uri;
        });
        var lokasi = $("#lokasi").val();
        $.ajax({
            type: 'POST',
            url: 'presensi/store',
            data: {
                _token: "{{ csrf_token() }}",
                image: gambar,
                location: lokasi,
            },
            success: function(response) {
                
            }
        })
    });

</script>
@endpush