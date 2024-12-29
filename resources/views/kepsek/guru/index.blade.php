@extends('kepsek.layouts.master')
@section('content')
<div class="p-6 mt-14 space-y-4">
    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Daftar Guru</h1>
    <div class="flex flex-column h-[70px] sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <form action="{{ route('kepsek.guru') }}" method="GET">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="cari" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" value="{{ old('cari', $cari) }}" placeholder="Cari guru . . ." name="cari">
            </form>
        </div>
    </div>
    <div id="data-table" class="relative border border-gray-400 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th class="px-6 py-3">
                        Nama Guru
                    </th>
                    <th class="px-6 py-3">
                        NIP
                    </th>
                    <th class="px-6 py-3">
                        Mata Pelajaran
                    </th>
                    <th class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach($guru as $key => $g)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">
                        {{ $guru->firstItem() + $key }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $g->nama_guru }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $g->nip }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $g->mapel->nama_mapel_lengkap }}
                    </td>
                    <td class="px-6 py-4">
                        <button type="button" id="modal-toggle-{{ $g->id }}" data-modal-target="modal-{{ $g->id }}" data-modal-toggle="modal-{{ $g->id }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Icon description</span>
                        </button>

                        <!-- Main modal -->
                        <div id="modal-{{ $g->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            {{ $g->nama_guru }}
                                        </h3>
                                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="modal-{{ $g->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        @if($g->pas_foto)
                                        <img src="{{ asset('storage/' . $g->pas_foto) }}" width="200" class="mx-auto" alt="foto guru {{ $g->nama_guru }}">
                                        @else
                                        <div class="w-40 h-40 rounded-md mx-auto shadow-lg text-6xl bg-gray-200 rounded flex items-center justify-center text-center">{{ strtoupper(substr($g->nama_guru, 0, 2)) }}</div>
                                        @endif
                                        <div>
                                            <h2 class="my-4 text-lg font-semibold text-gray-900 dark:text-white">Identitas Pribadi:</h2>
                                            <ul class="max-w-md space-y-2 text-gray-500 list-disc list-inside dark:text-gray-400">
                                                <li>
                                                    Nama Guru: {{ $g->nama_guru }}
                                                </li>
                                                <li>
                                                    NIP: {{ $g->nip }}
                                                </li>
                                                <li>
                                                    Email: {{ $g->email }}
                                                </li>
                                                <li>
                                                    Tahun STTB: {{ $g->tahun_sttb }}
                                                </li>
                                                <li>
                                                    Tempat, Tanggal Lahir: {{ $g->tempat_lahir }}, {{ \Carbon\Carbon::parse($g->tanggal_lahir)->format('d F Y') }}
                                                </li>
                                            </ul>

                                        </div>
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
            {{ $guru->links() }}
        </div>
    </div>
</div>
@endsection