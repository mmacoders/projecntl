<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  @page { 
    size: A4
  }

  .table-data-employee {
    margin-top: 40px;
  }

  .table-data-employee td {
    padding: 5px;
  }

  .table-presence {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
  }

  .table-presence > tr, th {
    border: 2px solid black;
    padding: 8px;
    background: #9f9d9d;
  }

  .table-presence > tr > td {
    border: 2px solid black;
    padding: 5px;
    font-size: 12px;
  }
  
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{ asset('assets/img/icon/192x192.png') }}" alt="" width="100" height="100">
            </td>
            <td>
              <h3>
                Laporan Presensi<br>
                Periode {{ $months[$month] }} {{ $year }}<br>
                PT. Koperasi Internet Network Gorontalo
              </h3>
            </td>
        </tr>
    </table>

    <table class="table-data-employee">
      <tr>
        <td rowspan="4">
          @php
              $path = Storage::url('uploads/employee/' . $employee->photo);
          @endphp
          <img src="{{ url($path) }}" alt="" width="200" height="200">
        </td>
      </tr>
      <tr>
        <td>ID Karyawan</td>
        <td>:</td>
        <td>{{ $employee->id_employee }}</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $employee->fullname }}</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $employee->position }}</td>
      </tr>
    </table>

    <table style="" class="table-presence">
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jam masuk</th>
        <th>Foto</th>
        <th>Lokasi</th>
        <th>Keterangan</th>
      </tr>
      @foreach ($presence as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ date('d-m-Y', strtotime($p->presence_at)) }}</td>
          <td>{{ $p->check_in }}</td>
        </tr>
      @endforeach
    </table>

  </section>

</body>

</html>