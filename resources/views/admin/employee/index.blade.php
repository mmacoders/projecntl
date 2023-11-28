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
                      <div class="table-responsive">
                        <table
            class="table table-vcenter card-table table-striped">
                          <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
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
                                <td class="text-secondary" >
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
@endsection