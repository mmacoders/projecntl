@extends('layouts.master-admin')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">
                Data Karyawan
              </h2>
            </div>
          </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                              <a href="#" class="btn btn-primary d-none d-sm-inline-block" id="to-add-employee" data-bs-toggle="modal" data-bs-target="#modal-report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                Tambah Karyawan
                              </a>
                            </div>
                          </div>
                        </div>

                        <div class="table-responsive">
                          <table class="table table-vcenter card-table table-striped">
                            <thead>
                              <tr>
                                  <th>No</th>
                                  <th>ID</th>
                                  <th>Nama</th>
                                  <th>Jabatan</th>
                                  <th>Role</th>
                                  <th class="w-1"></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($employees as $employee)
                              <tr>
                                  <td>{{ $loop->interation() }}</td>
                                  <td>{{ $employee->nik }}</td>
                                  <td>
                                      <div class="d-flex py-1 align-items-center">
                                        <span class="avatar me-2" style="background-image: url(./static/avatars/006m.jpg)"></span>
                                        <div class="flex-fill">
                                          <div class="font-weight-medium">Lorry Mion</div>
                                          <div class="text-secondary"><a href="#" class="text-reset">lmiona@livejournal.com</a></div>
                                        </div>
                                      </div>
                                  </td>
                                  <td class="text-secondary">
                                      {{ $employee->position }}
                                  </td>
                                  <td class="text-secondary" >
                                      User
                                  </td>
                                  <td>
                                      <a href="#">Edit</a>
                                  </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>
                  </div>
            </div>
        </div> 
    </div>

    <div class="modal modal-blur fade" id="modal-add-employee" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah data karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label class="form-label">ID Karyawan</label>
                    <input type="text" class="form-control" name="id_karyawan">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="fullname">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="position">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="mb-3">
                    <div class="form-label">Foto</div>
                      <input type="file" class="form-control" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <button class="btn btn-primary w-100">
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
@push('modal-employee-script')
    <script>
      $(function() {
        $("#to-add-employee").click(function() {
          $("#modal-add-employee").modal("show");
        });
      });
    </script>
@endpush