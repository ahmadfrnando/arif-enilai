@extends('guru.layouts.master')

@section('content')
<div class="p-4 mt-14">
    <a href="{{ route('guru.lulus-semester') }}" class="text-white bg-blue-700 mb-4 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
        </svg>
        <span class="sr-only">Kembali</span>
        Kembali
    </a>
    <div class="grid grid-cols-4 gap-4 mb-4">
        <div class="bg-white border border-gray-200 rounded-lg shadow">
            <div class="flex flex-col items-center pb-10 pt-10">
                @if($siswa->pas_foto)
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ $siswa->pas_foto }}" alt="Bonnie image" />
                @else
                <div class="w-40 h-40 rounded-full shadow-lg text-6xl bg-gray-200 rounded flex items-center justify-center text-center">{{ strtoupper(substr($siswa->nama_siswa, 0, 2)) }}</div>
                @endif
                <h5 class="mb-1 text-xl font-medium text-gray-900">{{ $siswa->nama_siswa }}</h5>
                <span class="text-sm text-gray-500">{{ $siswa->nisn }}</span>
                @if($cekLulusSemester == null)
                <div class="flex mt-4 md:mt-6">
                    <button type="button" data-modal-target="popup-modal-1" data-modal-toggle="popup-modal-1" class="flex flex-row items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 {!! $cekLulusMapel->count() > 0 ? 'cursor-not-allowed' : '' !!} " {!! $cekLulusMapel->count() > 0 ? 'disabled' : '' !!}>
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>
                        Lulus
                    </button>
                    <div id="popup-modal-1" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-1">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah anda yakin ingin memberikan kelulusan semester terhadap nilai pada siswa <b>{{ $siswa->nama_siswa }}</b> di kelas <b>{{ $siswa->kelas->nama_kelas }}</b> selama <b>{{ $siswa->semester_sekarang }} semester </b> ini?</h3>
                                    <form action="{{ route('guru.lulus-semester.create') }}" method="POST">
                                        @csrf
                                        <input type="number" name="id_siswa" value="{{ $siswa->id }}" hidden readonly>
                                        <input type="number" name="semester" value="{{ $siswa->semester_sekarang }}" hidden readonly>
                                        <input type="number" name="id_kelas" value="{{ $siswa->id_kelas_sekarang }}" hidden readonly>
                                        <input type="number" name="id_guru" value="{{ Auth()->user()->id_guru }}" hidden readonly>
                                        <input type="number" name="id_status" value="1" hidden readonly>
                                        <div class="py-4">
                                            <select id="tahun_ajaran" name="tahun_ajaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                                <option value="" selected>-- Pilih Tahun Ajaran --</option>
                                                @foreach($pilihTahunAjaran as $p)
                                                <option value="{{ $p->id }}" selected>{{ $p->tahun_ajaran }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="py-4">
                                            <textarea id="pesan" name="pesan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="berikan pesan anda untuk siswa dan orang tua siswa disini..."></textarea>
                                        </div>
                                        <button type="submit" data-modal-hide="popup-modal-1" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Ya, saya yakin!
                                        </button>
                                        <button data-modal-hide="popup-modal-1" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-modal-target="popup-modal-2" data-modal-toggle="popup-modal-2" class="flex flex-row py-2 px-4 ms-2 text-sm font-medium text-white focus:outline-none bg-red-700 rounded-lg border border-red-200 hover:bg-red-100 {!! $cekLulusMapel->count() > 0 ? 'cursor-not-allowed' : '' !!} hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-red-100" {!! $cekLulusMapel->count() > 0 ? 'disabled' : '' !!}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Tidak Lulus
                    </button>
                    <div id="popup-modal-2" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-2">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah anda yakin ingin memberikan kelulusan semester terhadap nilai pada siswa <b>{{ $siswa->nama_siswa }}</b> di kelas <b>{{ $siswa->kelas->nama_kelas }}</b> selama <b>{{ $siswa->semester_sekarang }} semester </b> ini?</h3>
                                    <form action="{{ route('guru.lulus-semester.create') }}" method="POST">
                                        @csrf
                                        <input type="number" name="id_siswa" value="{{ $siswa->id }}" hidden readonly>
                                        <input type="number" name="semester" value="{{ $siswa->semester_sekarang }}" hidden readonly>
                                        <input type="number" name="id_kelas" value="{{ $siswa->id_kelas_sekarang }}" hidden readonly>
                                        <input type="number" name="id_guru" value="{{ Auth()->user()->id_guru }}" hidden readonly>
                                        <input type="number" name="id_status" value="2" hidden readonly>
                                        <div class="py-4">
                                            <select id="tahun_ajaran" name="tahun_ajaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                                <option value="" selected>-- Pilih Tahun Ajaran --</option>
                                                @foreach($pilihTahunAjaran as $p)
                                                <option value="{{ $p->id }}" selected>{{ $p->tahun_ajaran }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="py-4">
                                            <textarea id="alasan" name="alasan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Berikan alasan ketidaklulusan..."></textarea>
                                        </div>
                                        <button type="submit" data-modal-hide="popup-modal-2" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Ya, beri alasan!
                                        </button>
                                        <button data-modal-hide="popup-modal-2" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="m-4 flex items-center p-4  text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Info!</span> Anda telah memverifikasi kelulusan semester pada siswa {{ $siswa->nama_siswa }} dengan status {{ $cekLulusSemester->nama_status }} pada kelas {{ $siswa->kelas->nama_kelas }} di semester {{ $siswa->semester_sekarang }}
                    </div>
                </div>
                @endif
                @if($cekLulusMapel->count() > 0)
                <div class="flex m-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">info</span>
                    <div>
                        <span class="font-medium">Info! masih ada mata kuliah yang belum diverifikasi lulus yaitu:</span>
                        @foreach($cekLulusMapel as $c)
                        <ul class="mt-1.5 list-disc list-inside">
                            <li>{{ $c->nama_mapel }}</li>
                        </ul>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-span-3">
            <table class="text-sm border text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th class="px-6 py-3">
                            Nama Mata Pelajaran
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
                        <th class="px-6 py-3">
                            Lulus Mapel
                        </th>
                        <th class="px-6 py-3">
                            Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswaLulusMapel as $s)
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $s->mapel->nama_mapel }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->mapel->kkm }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->mapel->nilaiPengetahuan->nilai_pengetahuan ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->mapel->nilaiPengetahuan->predikat ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->mapel->nilaiKeterampilan->nilai_keterampilan ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->mapel->nilaiKeterampilan->predikat ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($s->id_status == 1)
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $s->nama_status }}</span>
                            @elseif($s->id_status == 2)
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded whitespace-nowrap">{{ $s->nama_status }}</span>
                            @else
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Belum diverifikasi</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->alasan ?? '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection