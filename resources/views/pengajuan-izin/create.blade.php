@extends('layouts.master-user')
@section('header')
<!-- App Header -->
 <div class="appHeader bg-danger text-light">
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
<div class="section content-master-user">
    <div class="row">
        <div class="col">
            <form action="{{ route('pengajuan-izin.store') }}" method="POST" id="form-pengajuan-izin">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control datepicker" placeholder="Tanggal" id="izinAt" name="izinAt" autocomplete="off">
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="">-- Jenis pengajuan --</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5" placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success w-100">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('pengajuan-izin-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
@endpush

@push('pengajuan-izin-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" integrity="sha512-NiWqa2rceHnN3Z5j6mSAvbwwg3tiwVNxiAQaaSMSXnRRDh5C2mk/+sKQRw8qjV1vN4nf8iK2a0b048PnHbyx+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
     $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'    
            });

            $('#izinAt').change(function(e) {
                const izinAt = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '/pengajuan-izin/cek',
                    data: {
                        _token: '{{ csrf_token() }}',
                        izinAt: izinAt
                    },
                    success: (response) => {
                        if(response == 1) {
                            Swal.fire({
                                title: 'Oops!',
                                text: 'Anda sudah melakukan pengajuan izin pada tanggal tersebut',
                                icon: 'warning',
                            }).then((result) => {
                                $('#izinAt').val('');
                            });
                        }
                    }
                });
            });

            $('#form-pengajuan-izin').submit(function() {
                const izinAt = $('#izinAt').val();
                const status = $('#status').val();
                const keterangan = $('#keterangan').val();

                if(izinAt === '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Tanggal harus diisi',
                        icon: 'warning',
                    });
                    return false;
                } else if(status === '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Jenis pengajuan harus diisi',
                        icon: 'warning',
                    });
                    return false;
                } else if(keterangan === '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Keterangan harus diisi',
                        icon: 'warning',
                    });
                    return false;
                }
            });
        });
</script>
@endpush