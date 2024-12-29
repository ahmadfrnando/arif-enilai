@extends('guru.layouts.master')
@section('content')
<div class="p-6 mt-14 space-y-4">
    <h1 class="text-3xl font-bold text-gray-900">Verifikasi Kelulusan Semester {{ $waliKelas->kelas->nama_kelas }}</h1>
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
        <label for="cari" class="sr-only">Search</label>
        <div class="relative">
            <form action="{{ route('guru.lulus-semester') }}" method="GET">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="cari" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari" value="{{ request('cari') }}" name="cari">
            </form>
        </div>
    </div>
    <div class="relative border border-gray-400 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th class="px-6 py-3">
                        Nama Lengkap
                    </th>
                    <th class="px-6 py-3">
                        Kelulusan Semester
                    </th>
                    <th class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach($siswaLulusSemester as $key => $s)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $siswaLulusSemester->firstItem() + $key }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $s->nama_siswa ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($s->siswaLulusSemester)
                        @if($s->siswaLulusSemester->id_status == 1)
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $s->siswaLulusSemester->nama_status }}</span>
                        @elseif($s->siswaLulusSemester->id_status == 2)
                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $s->siswaLulusSemester->nama_status }}</span>
                        @endif
                        @else
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">belum diset</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('guru.lulus-semester-detail', ['id_siswa' => $s->id]) }}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-6 h-6 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 0 0-1 1H6a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2a1 1 0 0 0-1-1H9Zm1 2h4v2h1a1 1 0 1 1 0 2H9a1 1 0 0 1 0-2h1V4Zm5.707 8.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd" />
                            </svg>
                            Beri Kelulusan
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $siswa->links() }}
        </div>
    </div>
</div>
@endsection