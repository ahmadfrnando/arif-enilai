@extends('siswa.layouts.master')
@section('content')
<div class="p-4 mt-14">
    <h1 class="py-4 text-2xl font-bold tracking-tight text-gray-900">Nilai Semester Saat Ini <span class="mb-14 text-gray-400 font-bold text-xl">(Kelas {{ $siswa->kelas->nama_kelas }} - Semester {{ $siswa->semester_sekarang }})</span></h1>
    <div id="data-table" class="border border-gray-400 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th class="px-6 py-3">
                        Mata pelajaran
                    </th>
                    <th class="px-6 py-3">
                        KKM
                    </th>
                    <th class="px-6 py-3">
                        Nilai Pengetahuan
                    </th>
                    <th class="px-6 py-3">
                        Predikat
                    </th>
                    <th class="px-6 py-3">
                        Nilai Keterampilan
                    </th>
                    <th class="px-6 py-3">
                        Predikat
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiSiswa as $key => $m)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $m->mapel->nama_mapel_lengkap }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $m->mapel->kkm }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $m->nilai_pengetahuan ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $m->predikat_pengetahuan ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $m->nilai_keterampilan ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $m->predikat_keterampilan ?? '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection