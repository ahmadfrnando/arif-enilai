@extends('guru.layouts.master')

@section('content')
<div class="p-4 mt-14">
    <a href="{{ route('guru.dashboard') }}" class="text-white mb-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
        <svg class="w-5 h-5 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
        </svg>
        Kembali ke dashboard
    </a>
    <div class="grid grid-cols-1 gap-4 mb-4">
        <div class="w-full py-6 bg-white border border-gray-200 rounded-lg shadow">
            <div class="flex flex-col items-center pb-10">
                @if (Auth::user()->foto)
                <img class="w-70 h-70 mb-3 shadow-lg" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Bonnie image" />
                @else
                <div class="w-72 h-72 mb-3 text-6xl shadow-lg bg-gray-200 rounded flex items-center justify-center text-center">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                @endif
                <h5 class="mb-1 text-lg font-medium text-gray-900">{{ $guru->nama_guru }}</h5>
                <span class="text-md text-gray-500">{{ $guru->nip }}</span>
            </div>
        </div>
    </div>
    <form action="{{ route('guru.profile-update') }}" method="post">
        @csrf
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="mb-5">
                <label for="nama_guru" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap Guru</label>
                <input type="text" id="nama_guru" name="nama_guru" value="{{ $guru->nama_guru }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap Guru</label>
                <input type="email" id="email" name="email" value="{{ $guru->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                <select type="text" id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-5">
                <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $guru->tempat_lahir }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $guru->tanggal_lahir }}">
            </div>
            <div class="mb-5">
                <label for="agama" class="block mb-2 text-sm font-medium text-gray-900">Agama</label>
                <select type="text" id="agama" name="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="Islam" {{ $guru->jenis_kelamin == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $guru->jenis_kelamin == 'Kristen' ? 'selected' : '' }}>jenis_kelamin</option>
                    <option value="Katolik" {{ $guru->jenis_kelamin == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ $guru->jenis_kelamin == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Budha" {{ $guru->jenis_kelamin == 'Budha' ? 'selected' : '' }}>Budha</option>
                    <option value="Konghucu" {{ $guru->jenis_kelamin == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>
            <div class="mb-5">
                <label for="tanggal_mulai_tugas" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Mulai Tugas</label>
                <input type="date" id="tanggal_mulai_tugas" name="tanggal_mulai_tugas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $guru->tanggal_mulai_tugas }}" readonly>
            </div>
            <div class="mb-5">
                <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $guru->jabatan }}" readonly>
            </div>
            <div class="mb-5">
                <label for="jenis_sekolah" class="block mb-2 text-sm font-medium text-gray-900">Jenis Sekolah</label>
                <input type="text" id="jenis_sekolah" name="jenis_sekolah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $guru->jenis_sekolah }}" readonly>
            </div>
            <div class="mb-5">
                <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-900">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $guru->jurusan }}" readonly>
            </div>
            <div class="mb-5">
                <label for="tahun_sttb" class="block mb-2 text-sm font-medium text-gray-900">Tahun STTB</label>
                <input type="text" id="tahun_sttb" name="tahun_sttb" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $guru->tahun_sttb }}" readonly>
            </div>
            <div class="mb-5">
                <label for="penataran_yang_pernah_diikutin" class="block mb-2 text-sm font-medium text-gray-900">Penatarann Yang Pernah Dilakuka</label>
                <input type="text" id="penataran_yang_pernah_diikutin" name="penataran_yang_pernah_diikutin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $guru->penataran_yang_pernah_diikutin }}" readonly>
            </div>
            <div class="mb-5">
                <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $guru->keterangan }}" readonly>
            </div>
        </div>
        <div class="flex mb-4">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Simpan</button>
        </div>
    </form>
</div>
@endsection