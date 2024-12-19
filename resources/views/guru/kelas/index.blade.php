@extends('guru.layouts.master')

@section('content')
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <div class="relative p-4 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full striped text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Kelas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Siswa
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas as $k)
                <tr class="odd:bg-white even:bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $k->nama_kelas ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $k->jumlah_siswa ?? '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <data value="
        "
        xx
        ></data>
    </div>
</div>
@endsection