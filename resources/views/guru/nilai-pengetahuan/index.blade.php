@extends('guru.layouts.master')

@section('content')
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>

                <form method="GET" action="{{ route('guru.filter-nilai-pengetahuan') }}" class="mx-auto flex gap-4">
                    @csrf
                    <select id="kelas" name="pilihKelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Pilih Kelas</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ request('pilihKelas') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pilih</button>
                </form>
            </div>
            <label for="cari" class="sr-only">Search</label>
            <div class="relative">
                <form action="{{ route('guru.cari-nilai-pengetahuan') }}" method="GET">
                    @csrf
                    <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="cari" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari" value="{{ request('cari') }}" name="cari">
                </form>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Lengkap
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kelas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nilai Pengetahuan {{ $mapel->nama_mapel ?? '-' }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Predikat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach($siswa as $s)
                <tr class="odd:bg-white even:bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $s->nama_siswa ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $s->kelas->nama_kelas ?? '-' }}
                    </td>
                    <td class="px-6 py-4 font-extrabold">
                        {{ $s->nilaiPengetahuan->nilai_pengetahuan ?? '-' }}
                    </td>
                    <td class="px-6 py-4 font-extrabold">
                        {{ $s->nilaiPengetahuan->predikat ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <!-- Modal toggle -->
                        <button id="modal-toggle-{{ $s->id }}" data-modal-target="modal-{{ $s->id }}" data-modal-toggle="modal-{{ $s->id }}" @if($s->nilaiPengetahuan && $s->nilaiPengetahuan->nilai_pengetahuan)
                            disabled
                            @endif
                            class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 @if($s->nilaiPengetahuan && $s->nilaiPengetahuan->nilai_pengetahuan)
                            cursor-not-allowed
                            @endif focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900" type="button">
                            Beri Nilai
                        </button>

                        <!-- Main modal -->
                        <div id="modal-{{ $s->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            {{ $s->nama_siswa ?? ' ' }} - {{ $s->kelas->nama_kelas ?? ' ' }} ({{ $mapel->nama_mapel ?? ' ' }})
                                        </h3>
                                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-{{ $s->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <form class="space-y-4" action="{{ route('guru.input-nilai-pengetahuan') }}" method="POST">
                                            @csrf
                                            <input type="text" hidden readonly name="id_siswa" value="{{ $s->id }}">
                                            <input type="text" hidden readonly name="id_mapel" value="{{ $mapel->id }}">
                                            <input type="text" hidden readonly name="id_guru" value="{{ $id_guru }}">
                                            <input type="text" hidden readonly name="id_kelas" value="{{ $s->id_kelas_sekarang }}">
                                            <div>
                                                <label for="nilai_pengetahuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Silahkan masukkan nilai pengetahuan</label>
                                                <input type="number" name="nilai_pengetahuan" id="nilai_pengetahuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                            </div>
                                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
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
</div>
@endsection