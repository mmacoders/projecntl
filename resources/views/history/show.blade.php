@if ($history->isEmpty())
    <div class="alert alert-warning">
        <p>Data tidak tersedia</p>
    </div>
@endif
@foreach ($history as $h)
<ul class="listview image-listview">
    <li>
        <div class="item">
            @php
                $path = Storage::url('uploads/absensi/' . $h->photo_in)
            @endphp
            <img src="{{ url($path) }}" alt="image" class="image">
            <div class="in">
                <div>
                    <b>{{ date('d-m-Y', strtotime($h->attend_date)) }}</b><br>
                </div>
                <span class="badge {{ $h->check_in < '07:00' ? 'bg-succes' : 'bg-danger' }}">
                    {{ $h->check_in }}
                </span>
            </div>
        </div>
    </li>
</ul>
@endforeach