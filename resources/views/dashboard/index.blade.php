@extends('layouts.master-user')
@section('content')
<div class="section" id="user-section">
    {{-- <a href="{{ route('logout') }}" >
        <ion-icon name="log-out-outline"></ion-icon>
    </a> --}}
    <div id="user-detail">
        <div class="avatar">
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
        </div>
        <div id="user-info">
            <h2 id="user-name">John Doe</h2>
            <span id="user-role">Head of IT</span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="green" style="font-size: 40px;">
                            <ion-icon name="person"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="danger" style="font-size: 40px;">
                            <ion-icon name="calendar-number-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Izin</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Riwayat</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="orange" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($attendance != null)
                                    @php
                                        $path = Storage::url('uploads/absensi/' . $attendance->photo_in);
                                    @endphp
                                    <img src="{{ url($path) }}" alt="" class="imaged w48">
                                @else
                                    <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>{{ $attendance != null ? $attendance->check_in : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($attendance != null && $attendance->check_out != null)
                                @php
                                    $path = Storage::url('uploads/absensi/' . $attendance->photo_out);
                                @endphp
                                    <img src="{{ url($path) }}" alt="" class="imaged w48">
                                @else
                                    <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{ $attendance != null && $attendance->check_out != null ? $attendance->check_out : 'Belum absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="rekap-presence">
        <h3>Rekap presensi Januari 2023</h3>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center card-rekap-presence">
                        <span class="badge bg-danger badge-rekap-presence">{{ $rekapAttendance->jmlh_hadir }}</span>
                        <ion-icon name="finger-print-outline" class="text-success mb-1 icon-rekap-presence"></ion-icon>
                        <br>
                        <span class="txt-rekap-presence">Hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center card-rekap-presence">
                        <span class="badge bg-danger badge-rekap-presence">{{ $rekapAttendance->jmlh_terlambat }}</span>
                        <ion-icon name="timer-outline" class="text-danger mb-1 icon-rekap-presence"></ion-icon>
                        <br>
                        <span class="txt-rekap-presence">Terlambat</span>
                    </div>
                </div>
        </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center card-rekap-presence">
                        <span class="badge bg-danger badge-rekap-presence">{{ $rekapIzin->jmlh_izin }}</span>
                        <ion-icon name="calendar-number-outline" class="text-info mb-1 icon-rekap-presence"></ion-icon>
                        <br>
                        <span class="txt-rekap-presence">Izin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center card-rekap-presence">
                        <span class="badge bg-danger badge-rekap-presence">{{ $rekapIzin->jmlh_sakit }}</span>
                        <ion-icon name="medkit-outline" class="text-warning mb-1 icon-rekap-presence"></ion-icon>
                        <br>
                        <span class="txt-rekap-presence">Sakit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($historyOfThisMonth as $history)
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="finger-print-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>{{ date('d-m-Y', strtotime($history->attend_date)) }}</div>
                                <span class="badge badge-success">{{ $history->check_in }}</span>
                                <span class="badge badge-danger">{{ $attendance != null && $history->check_out != null ? $history->check_out : 'Belum absen' }}</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($leaderboard as $lb)
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>
                                    <b>{{ $lb->username }}</b><br>
                                    <small class="text-muted">Jabatan</small>
                                </div>
                                <span class="badge {{ $lb->check_in < '07:00' ? 'bg-succes' : 'bg-danger' }}">
                                    {{ $lb->check_in }}
                                </span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection