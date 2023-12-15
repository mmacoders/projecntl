@extends('layouts.master-admin')
<!-- Page header -->
@section('content')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Laporan Presensi
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form action="/admin/presence/cetak-laporan" target="_blank" method="POST">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <select name="month" id="month" class="form-select">
                      <option value="">Bulan</option>
                      @for ($i = 1; $i <= 12; $i++)
                      <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>{{ $months[$i] }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <div class="form-group">
                    <select name="year" id="year" class="form-select">
                      <option value="">Tahun</option>
                      @php
                        $startYear = 2023;
                        $currentYear = date('Y');
                      @endphp
                      @for ($year = $startYear; $year <= $currentYear; $year++)
                      <option value="{{ $year }}" {{ date('Y') == $year ? 'selected' : '' }}>{{ $year }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <div class="form-group">
                    <select name="id_employee" id="idEmployee" class="form-select">
                      <option value="">Pilih karyawan</option>
                      @foreach ($employees as $employee)
                          <option value="{{ $employee->id_employee }}">{{ $employee->fullname }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                      Cetak
                    </button>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100" download>Ekspor</button>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection