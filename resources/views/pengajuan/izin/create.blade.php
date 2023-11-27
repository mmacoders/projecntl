@extends('layouts.master-user')
@section('header')
<!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="{{ route('pengajuan-izin') }}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Form Izin</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form action="{{ route('pengajuan-izin.store') }}" method="POST" enctype="multipart/form-data" id="form-pengajuan-izin">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control datepicker" placeholder="Tanggal" id="tgl_izin" name="tgl_izin">
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="">-- Jenis pengajuan --</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5" placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary w-100">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('pengajuan-izin-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
@endpush

@push('pengajuan-izin-script')
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'    
            });

            $('#form-pengajuan-izin').submit(function() {
                let tglIzin = $('#tgl_izin').val();
                let status = $('#status').val();
                let keterangan = $('#keterangan').val();

                if(tglIzin === '') {
                    Swal.fire({
                        title: 'Whoops!',
                        text: 'Tanggal harus diisi',
                        icon: 'warning',
                    });
                    return false;
                } else if(status === '') {
                    Swal.fire({
                        title: 'Whoops!',
                        text: 'Jenis pengajuan harus diisi',
                        icon: 'warning',
                    });
                    return false;
                } else if(keterangan === '') {
                    Swal.fire({
                        title: 'Whoops!',
                        text: 'Keterangan harus diisi',
                        icon: 'warning',
                    });
                    return false;
                }
            });
        });
    </script>
@endpush