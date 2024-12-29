@extends('kepsek.layouts.master')
@section('content')
<div class="p-6 mt-14 space-y-4">
    <h1 class="text-2xl font-semibold">Nilai Pengetahuan</h1>
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
        <div class="flex gap-4">
            <form method="GET" action="{{ route('kepsek.nilai-pengetahuan') }}" class="mx-auto flex gap-4">
                <select id="kelas" name="pilihKelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" selected>Semua Kelas</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('pilihKelas') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
                <select id="mapel" name="pilihMapel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" selected>Semua Mapel</option>
                    @foreach($mapel as $m)
                    <option value="{{ $m->id }}" {{ request('pilihMapel') == $m->id ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                    @endforeach
                </select>
                <select id="semester" name="pilihSemester" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" selected>Semua Semester</option>
                    <option value="1" {{ request('pilihSemester') == '1' ? 'selected' : '' }}>
                        Semester I
                    </option>
                    <option value="2" {{ request('pilihSemester') == '2' ? 'selected' : '' }}>
                        Semester II
                    </option>
                </select>
                <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Pilih</button>
            </form>
            <a href="{{ route('kepsek.nilai-pengetahuan') }}" class="flex">
                <button class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Reset</button>
            </a>
        </div>
        <label for="cari" class="sr-only">Search</label>
        <div class="relative">
            <form action="{{ route('kepsek.nilai-pengetahuan') }}" method="GET">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="cari" name="cari" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari" value="{{ request('cari') }}" name="cari">
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
                        Kelas
                    </th>
                    <th class="px-6 py-3">
                        Semester
                    </th>
                    <th class="px-6 py-3">
                        Mata Pelajaran
                    </th>
                    <th class="px-6 py-3">
                        Nilai Pengetahuan
                    </th>
                    <th class="px-6 py-3">
                        Predikat
                    </th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach($nilaiPengetahuan as $key => $n)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $nilaiPengetahuan->firstItem() + $key }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $n->siswa->nama_siswa ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $n->kelas->nama_kelas ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $n->siswa->semester_sekarang ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $n->mapel->nama_mapel ?? '-' }}
                    </td>
                    <td class="px-6 py-4 font-extrabold">
                        {{ $n->nilai_pengetahuan }}
                    </td>
                    <td class="px-6 py-4 font-extrabold">
                        {{ $n->predikat}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $nilaiPengetahuan->links() }}
        </div>
    </div>
</div>
@endsection