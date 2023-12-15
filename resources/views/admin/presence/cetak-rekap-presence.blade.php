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

  .table-presence tr th {
    border: 1px solid black;
    padding: 8px;
    background: #9f9d9d;
    font-size: 10px;
  }

  .table-presence tr td {
    border: 1px solid black;
    padding: 5px;
    font-size: 12px;
  }
  
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{ asset('assets/img/icon/192x192.png') }}" alt="" width="100" height="100">
            </td>
            <td>
                LAPORAN PRESENSI KARYAWAN><br>
                PERIODE {{ strtoupper($months[$month]) }} {{ $year }}<br>
                PT. TELKOM AKSES OFFICE GORONTALO
              </h3>
            </td>
        </tr>
    </table>

    <table class="table-presence">
        <tr>
            <th rowspan="2">Nama</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">Total Hadir</th>
            <th rowspan="2">Total Terlambat</th>
        </tr>
        <tr>
            <?php
            for($i = 1; $i <= 31; $i++) {
            ?>
            <th>{{ $i }}</th>
            <?php
            }
            ?>
        </tr>
        @foreach ($rekapPresence as $rp)
            <tr>
                <td>{{ $rp->employee_id }}</td>
                <td>{{ $rp->fullname }}</td>

                <?php
                $totalPresence = 0;
                $totalTerlambat = 0;
                for($i = 1; $i <= 31; $i++) {
                    $tgl = "tgl_" . $i;

                    if(empty($rp->tgl)) {
                        $presence = ['', ''];
                        $totalPresence += 0;
                    } else {
                        $presence = explode('-', $rp->tgl);
                        $totalPresence += 1;

                        if($presence[0] >= "07:00:00") {
                            $totalTerlambat += 1;
                        }
                    }
                ?>

                <td>
                    <span style="{{ $presence[0] >= "07:00:00" ? "red" : "" }}">{{ $presence[0] }}</span><br>
                    <span style="{{ $presence[1] <= "17:00:00" ? "red" : "" }}">{{ $presence[0] }}</span><br>
                </td>
                <?php
                }
                ?>
                <td>{{ $totalPresence }}</td>
                <td>{{ $totalTerlambat }}</td>
            </tr>
        @endforeach
    </table>

    <table width="100%" style="margin-top: 100px">
      <tr>
        <td style="text-align: right">Gorontalo, {{ date('d-m-Y') }}</td>
      </tr>
      <tr>
        <td style="text-align: right; vertical-align:bottom" height="100px">
          <u>Name</u><br>
          <i><b>Jabatan</b></i>
        </td>
      </tr>
    </table>

  </section>

</body>

</html> )