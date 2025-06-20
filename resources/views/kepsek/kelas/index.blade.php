@extends('kepsek.layouts.master')

@section('content')
<div class="p-6 mt-14 space-y-4">
    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Data kelas</h1>
    <div class="relative border border-gray-400 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full striped text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th class="px-6 py-3">
                        Nama Kelas
                    </th>
                    <th class="px-6 py-3">
                        Jumlah Siswa
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas as $k)
                <tr class="odd:bg-white even:bg-gray-50 border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $k->nama_kelas ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $k->jumlahSiswa() ?? 0 }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="font-semibold text-gray-900 dark:text-white">
                    <th scope="row" colspan="2" class="px-6 py-3 text-base">Total Siswa</th>
                    <td class="px-6 py-3">{{ $siswa }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection