<table>
    <thead>
        <tr>
            <th colspan="5">Laporan Nilai Siswa</th>
        </tr>
        <tr>
            <td>Nama Siswa:</td>
            <td>{{ $student->nama_siswa }}</td>
            <td>Kelas:</td>
            <td>{{ $student->nama_kelas }}</td>
        </tr>
        <tr>
            <td>Semester:</td>
            <td>{{ $student->nama_semester }}</td>
            <td>Tahun Ajaran:</td>
            <td>{{ $student->tahun_ajaran }}</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Nama Mata Pelajaran</th>
            <th>KKM</th>
            <th>Nilai Pengetahuan</th>
            <th>Predikat Pengetahuan</th>
            <th>Nilai Keterampilan</th>
            <th>Predikat Keterampilan</th>
        </tr>

        <!-- Loop data grades -->
        @foreach ($grades as $gradeGroup)
        @foreach ($gradeGroup as $grade)
        <tr>
            <td>{{ $grade['nama_mapel'] }}</td>
            <td>{{ $grade['kkm'] }}</td>
            <td>{{ $grade['pengetahuan']['nilai'] }}</td>
            <td>{{ $grade['pengetahuan']['predikat'] }}</td>
            <td>{{ $grade['keterampilan']['nilai'] }}</td>
            <td>{{ $grade['keterampilan']['predikat'] }}</td>
        </tr>
        @endforeach
        @endforeach
    </tbody>

</table>