@extends('layouts.master-admin')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">
                Data Izin / Sakit
              </h2>
            </div>
          </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <table class="table table-vcenter table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>ID Karyawan</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Status Approve</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataIzin as $di)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-Y', strtotime($di->izin_at)) }}</td>
                                    <td>{{ $di->employee_id }}</td>
                                    <td>{{ $di->fullname }}</td>
                                    <td>{{ $di->position }}</td>
                                    <td>{{ $di->status == 'i' ? "Izin" : "Sakit" }}</td>
                                    <td>{{ $di->keterangan }}</td>
                                    <td>
                                        @if ($di->status_approved == 1)
                                            <span class="badge bg-success text-light">Disetujui</span>
                                        @elseif($di->status_approved == 2)
                                            <span class="badge bg-danger text-light">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-light">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($di->status_approved == 0)
                                            <div class="btn-list flex-nowrap">
                                                <a href="#" class="btn-primary btn btn-sm" id="status_approved" id_pengajuan_izin="{{ $di->id }}">
                                                   Validasi
                                                </a>
                                            </div>
                                        @else
                                            <form action="/admin/pengajuan-izin-karyawan/{{ $di->id }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn btn-danger btn-sm btn-delete-employee">
                                                   Batalkan
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-izin-employee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Izin / Sakit</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/pengajuan-izin-karyawan/update" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="id-pengajuan-izin-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <select class="form-select" name="status_approved" id="status_approved">
                                    <option value="1">Setujui</option>
                                    <option value="2">Tolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-primary w-100" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                            Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
@endsection
@push('pengajuan-izin-script')
    <script>
        $(function() {
            $("#status_approved").click(function(e) {
                e.preventDefault();
                const id = $(this).attr("id_pengajuan_izin");
                $("#id-pengajuan-izin-form").val(id);
                $("#modal-izin-employee").modal("show");
            });
        });
    </script>
@endpush