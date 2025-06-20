<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nilai Siswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <img src="{{ asset('logo_kartika.png') }}" alt="Logo Sekolah" style="width: 100px; height: 100px;">
    <h2 class="title">Laporan Nilai Siswa</h2>
    <table>
        <tr>
            <th>Nama Siswa:</th>
            <td>{{ $data->nama_siswa }}</td>
            <th>Kelas:</th>
            <td>{{ $data->nama_kelas }}</td>
        </tr>
        <tr>
            <th>Semester:</th>
            <td>{{ $data->nama_semester }}</td>
            <th>Tahun Ajaran:</th>
            <td>{{ $data->tahun_ajaran }}</td>

        </tr>
        <tr>
            <th>Nama Mata Pelajaran</th>
            <th>KKM</th>
            <th>Nilai Pengetahuan</th>
            <th>Predikat Pengetahuan</th>
            <th>Nilai Keterampilan</th>
            <th>Predikat Keterampilan</th>
        </tr>
        @if(is_array($data->nilai))
        @foreach($data->nilai as $nilaiGroup)
        @foreach($nilaiGroup as $r)
        <tr>
            <td>{{$r['nama_mapel']}}</td>
            <td>{{$r['kkm']}}</td>
            <td>{{$r['pengetahuan']['nilai']}}</td>
            <td>{{$r['pengetahuan']['predikat']}}</td>
            <td>{{$r['keterampilan']['nilai']}}</td>
            <td>{{$r['keterampilan']['predikat']}}</td>
        </tr>
        @endforeach
        @endforeach
        @endif
    </table>
    <script>
        window.print();
    </script>
</body>

</html>