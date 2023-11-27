@extends('layouts.master-user')
@section('header')
<!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="pageTitle">Data Izin / Sakit</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            @foreach ($dataIzin as $d)
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ date('d-m-Y', strtotime($d->tgl_izin)) }} ({{ $d->status == 'sakit' ? 'Sakit' : 'Izin' }})</b><br>
                                    <small class="text-muted">{{ $d->keterangan }}</small>
                                </div>
                                @if ($d->status_approved == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($d->status_approved == 1)
                                    <span class="badge bg-danger">Decline</span>
                                @else
                                    <span class="badge bg-success">Approved</span>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
    <div class="fab-button bottom-right permission-content" style="margin-bottom: 70px">
        <a href="{{ route('pengajuan-izin.create') }}" class="fab">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
@endsection