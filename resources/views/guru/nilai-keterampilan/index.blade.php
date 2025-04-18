@extends('guru.layouts.master')
@section('content')
<div class="p-6 mt-14 space-y-4">
    @if($semester_aktif === null)
    <div class="p-6 mt-14 space-y-4">
        <div class="flex flex-col gap-6 items-center justify-center">
            <img src="{{ asset('images/no-data.svg') }}" alt="no-data" width="200" class="mx-auto">
            <h1 class="text-3xl font-semibold text-gray-900">Semester belum diaktifkan</h1>
        </div>
    </div>
    @else
    <h1 class="text-3xl font-bold text-gray-900">Nilai Keterampilan</h1>
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
        <div class="flex gap-4">
            <form method="GET" action="{{ route('guru.nilai-keterampilan') }}" class="mx-auto flex gap-4">
                <select id="kelas" name="pilihKelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" selected>Semua Kelas</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('pilihKelas') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
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
            <a href="{{ route('guru.nilai-keterampilan') }}" class="flex">
                <button class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Reset</button>
            </a>
        </div>
        <label for="cari" class="sr-only">Search</label>
        <div class="relative">
            <form action="{{ route('guru.nilai-keterampilan') }}" method="GET">
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
                        Kelas
                    </th>
                    <th class="px-6 py-3">
                        Semester
                    </th>
                    <th class="px-6 py-3">
                        Nilai Keterampilan {{ $mapel->nama_mapel ?? '-' }}
                    </th>
                    <th class="px-6 py-3">
                        Predikat
                    </th>
                    <th class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach($siswa as $key => $s)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $siswa->firstItem() + $key }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $s->nama_siswa ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $s->kelas->nama_kelas ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $s->semester_sekarang ?? '-' }}
                    </td>
                    <td class="px-6 py-4 font-extrabold">
                        {{ $s->nilaiSiswa->where('semester_id', $semester_aktif->semester)->first()->nilai_keterampilan ?? '-' }}
                    </td>

                    <td class="px-6 py-4 font-extrabold">
                        {{ $s->nilaiSiswa->where('semester_id', $semester_aktif->semester)->first()->predikat_keterampilan ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <!-- Modal toggle -->
                        <button id="modal-toggle-{{ $s->id }}" data-modal-target="modal-{{ $s->id }}" data-modal-toggle="modal-{{ $s->id }}"
                            class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" type="button">
                            Beri Nilai
                        </button>

                        <!-- Main modal -->
                        <div id="modal-{{ $s->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            {{ $s->nama_siswa ?? ' ' }} - {{ $s->kelas->nama_kelas ?? ' ' }} ({{ $mapel->nama_mapel ?? ' ' }})
                                        </h3>
                                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="modal-{{ $s->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <form class="space-y-4" action="{{ route('guru.input-nilai-keterampilan') }}" method="POST">
                                            @csrf
                                            <input type="text" hidden readonly name="id_siswa" value="{{ $s->id }}">
                                            <input type="text" hidden readonly name="id_mapel" value="{{ $mapel->id }}">
                                            <input type="text" hidden readonly name="id_guru" value="{{ $id_guru }}">
                                            <input type="text" hidden readonly name="id_kelas" value="{{ $s->id_kelas_sekarang }}">
                                            <input type="text" hidden readonly name="semester_sekarang" value="{{ $s->semester_sekarang }}">
                                            <div>
                                                <label for="nilai_keterampilan" class="block mb-2 text-sm font-medium text-gray-900">Silahkan masukkan nilai keterampilan</label>
                                                <input type="number" name="nilai_keterampilan" id="nilai_keterampilan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                            </div>
                                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $siswa->links() }}
        </div>
    </div>
    @endif
</div>
@endsection