@foreach ($presence as $p)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $p->employee_id }}</td>
    <td>{{ $p->fullname }}</td>
    <td>
        <div class="d-flex py-1 align-items-center">
            <img src="{{ asset('storage/uploads/presence/' . $p->photo_in) }}" alt="" class="avatar me-2">
            <div class="flex-fill">
                <div class="font-weight-medium">{{ $p->check_in }}</div>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex py-1 align-items-center">
            @if ($p->check_out != null)
            <img src="{{ asset('storage/uploads/presence/' . $p->photo_out) }}" alt="" class="avatar me-2">
            @endif
            <div class="flex-fill">
                <div class="font-weight-medium">{!! $p->check_out != null ? $p->check_out : '<span class="badge bg-danger text-light">Belum Absen</span>' !!}</div>
            </div>
        </div>
    </td>
    <td>
        @if ($p->check_in > '07.00')
            <span class="badge bg-danger text-light">Terlambat</span>
        @else
            <span class="badge bg-success text-light">Tepat waktu</span>
        @endif
    </td>
</tr>
@endforeach