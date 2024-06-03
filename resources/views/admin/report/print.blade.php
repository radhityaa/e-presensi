<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $student->name }} | Laporan Absensi</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.min.css') }}">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="{{ asset('assets/css/paper.css') }}">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: bold;
        }

        .table {
            margin-top: 40px;
        }

        .table td {
            padding: 5px;
        }

        .address {
            font-size: 13px;
        }

        .table-presensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table-presensi tr th {
            border: 1px solid #131313;
            padding: 8px;
            background: #dbdbdb;
        }

        .table-presensi tr td {
            border: 1px solid #131313;
            padding: 8px;
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

        <table style="width: 100%;">
            <tr>
                <td style="width: 30px;">
                    <img src="{{ asset('assets/img/logo.png') }}" width="70" height="70">
                </td>
                <td>
                    <div id="title" style="text-transform: uppercase;">
                        Laporan Absensi Siswa<br />
                        Periode {{ $monthName[$month] }} {{ $year }}<br />
                        SMKN 3 Purwakarta
                    </div>
                    <div class="address"><i>Jln. Jend. Sudirman Gang. Melati 2 No. 56, Nagri Kaler, Purwakarta, Jawa
                            Barat</i></div>
                </td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <td rowspan="6">
                    @php
                        $path = Storage::url('uploads/students/' . $student->photo);
                    @endphp
                    <img src="{{ url($path) }}" alt="{{ $student->name }}" width="150px" height="150">
                </td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $student->nik }}</td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $student->Classroom->name }}</td>
            </tr>
            <tr>
                <td>Nomor HP</td>
                <td>:</td>
                <td>{{ $student->phone }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $student->address }}</td>
            </tr>
        </table>

        <table class="table-presensi">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>NIK</th>
                <th>Jam Masuk</th>
                <th>Foto</th>
                <th>Jam Pulang</th>
                <th>Foto</th>
                <th>Keterangan</th>
            </tr>
            @foreach ($presensis as $item)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->student->nik }}</td>
                    <td style="text-align: center;">{{ $item->jam_in ?? 'Belum Absen' }}</td>
                    <td style="text-align: center;">
                        @if ($item->image_in)
                            <img src="{{ $item->image_in }}" width="40" height="40">
                        @else
                            Belum Absen
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $item->jam_out ?? 'Belum Absen' }}</td>
                    <td style="text-align: center;">
                        @if ($item->image_out)
                            <img src="{{ $item->image_out }}" width="40" height="40">
                        @else
                            Belum Absen
                        @endif
                    </td>
                    <td>
                        @if ($item->jam_in > '07:00')
                            Terlambat {{ $item->difference }}
                        @else
                            Tepat Waktu
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        <table style="width: 100%; margin-top: 100px;">
            <tr>
                <td colspan="2" style="text-align: right;">Purwakarta, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: bottom; height: 150px;">
                    <div>
                        <u>Nama Walikelas</u>
                    </div>
                    <div>
                        <i><b>Walikelas</b></i>
                    </div>
                </td>
                <td style="text-align: center; vertical-align: bottom; height: 100px;">
                    <div>
                        <u>Nama Kepala Sekolah</u>
                    </div>
                    <div>
                        <i><b>Kepala Sekolah</b></i>
                    </div>
                </td>
            </tr>
        </table>
    </section>

</body>

</html>
