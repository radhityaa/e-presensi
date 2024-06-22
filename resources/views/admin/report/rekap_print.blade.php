<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rekap Absensi</title>

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
            font-size: 12px;
        }

        .table-presensi tr td {
            border: 1px solid #131313;
            padding: 8px;
            font-size: 12px;
        }

        .late {
            color: red;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 landscape">

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
                        Rekap Absensi Siswa<br />
                        Periode {{ $monthName[$month] }} {{ $year }}<br />
                        SMKN 3 Purwakarta
                    </div>
                    <div class="address"><i>Jln. Jend. Sudirman Gang. Melati 2 No. 56, Nagri Kaler, Purwakarta, Jawa
                            Barat</i></div>
                </td>
            </tr>
        </table>

        <table class="table-presensi">
            {{-- <tr>
                <th rowspan="2">NIK</th>
                <th rowspan="2">Nama</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">Total Hadir</th>
                <th rowspan="2">Total Terlambat</th>
            </tr>
            <tr>
                @for ($day = 1; $day <= 31; $day++)
                    <th>Tgl {{ $day }}</th>
                @endfor
            </tr>
            @foreach ($rekap as $item)
                <tr>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->name }}</td>
                    @for ($day = 1; $day <= 31; $day++)
                        @php
                            $dateTime = $item->{'tgl_' . $day};
                            if ($dateTime !== '') {
                                [$jamIn, $jamOut] = explode('-', $dateTime);
                                $formattedTimeIn = date('H:i:s', strtotime($jamIn));
                                $formattedTimeOut = $jamOut !== '00:00:00' ? date('H:i:s', strtotime($jamOut)) : '';
                                $isLate = strtotime($jamIn) > strtotime('07:00:00');
                            } else {
                                $formattedTimeIn = '';
                                $formattedTimeOut = '';
                                $isLate = false;
                            }
                        @endphp
                        <td class="{{ $isLate ? 'late' : '' }}">{{ $formattedTimeIn }} - {{ $formattedTimeOut }}</td>
                    @endfor
                </tr>
            @endforeach --}}

            <thead>
                <tr>
                    <th rowspan="2">NIK</th>
                    <th rowspan="2">Nama</th>
                    <th colspan="31">Tanggal</th>
                    <th rowspan="2">TH</th>
                    <th rowspan="2">TT</th>
                </tr>
                <tr>
                    @for ($day = 1; $day <= 31; $day++)
                        <th>{{ $day }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @php
                    $totalHadir = [];
                    $totalTerlambat = [];
                @endphp
                @foreach ($rekap as $item)
                    <tr>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->name }}</td>
                        @php
                            $hadir = 0;
                            $terlambat = 0;
                        @endphp
                        @for ($day = 1; $day <= 31; $day++)
                            @php
                                $dateTime = $item->{'tgl_' . $day};
                                if ($dateTime !== '') {
                                    [$jamIn, $jamOut] = explode('-', $dateTime);
                                    $isLate = strtotime($jamIn) > strtotime('07:00:00');
                                    if (!$isLate && $jamIn !== '') {
                                        $hadir++;
                                    } elseif ($isLate) {
                                        $terlambat++;
                                    }
                                }
                            @endphp
                            @if ($dateTime !== '')
                                <td style="padding: 1px;" class="{{ $isLate ? 'late' : '' }}">{{ $jamIn }} -
                                    {{ $jamOut !== '00:00:00' ? $jamOut : '' }}</td>
                            @else
                                <td></td>
                            @endif
                        @endfor
                        <td style="text-align: center; padding: 0px;">{{ $hadir }}</td>
                        <td style="text-align: center; padding: 0px;">{{ $terlambat }}</td>
                        @php
                            $totalHadir[$item->name] = isset($totalHadir[$item->name])
                                ? $totalHadir[$item->name] + $hadir
                                : $hadir;
                            $totalTerlambat[$item->name] = isset($totalTerlambat[$item->name])
                                ? $totalTerlambat[$item->name] + $terlambat
                                : $terlambat;
                        @endphp
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    @for ($day = 1; $day <= 31; $day++)
                        <th></th>
                    @endfor
                    <th>{{ array_sum($totalHadir) }}</th>
                    <th>{{ array_sum($totalTerlambat) }}</th>
                </tr>
            </tfoot>
        </table>

        <table style="width: 100%; margin-top: 100px;">
            <tr>
                <td></td>
                <td style="text-align: center;">Purwakarta, {{ date('d-m-Y') }}</td>
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
