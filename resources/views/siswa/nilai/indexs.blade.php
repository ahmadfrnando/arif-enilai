@extends('siswa.layouts.master')
@section('content')
<div class="p-4 mt-14">
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
        <div class="flex gap-4">
            <form id="filter-form" class="mx-auto flex gap-4">
                <div class="relative h-[70px]">
                    <select id="kelas" name="pilihKelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ request('pilihKelas') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                    <div id="kelas-error" class="text-red-500 text-sm hidden">Silakan pilih kelas.</div>
                </div>
                <div class="relative">
                    <select id="semester" name="pilihSemester" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Semester</option>
                        <option value="1" {{ request('pilihSemester') == '1' ? 'selected' : '' }}>
                            Semester I
                        </option>
                        <option value="2" {{ request('pilihSemester') == '2' ? 'selected' : '' }}>
                            Semester II
                        </option>
                    </select>
                    <div id="semester-error" class="text-red-500 text-sm hidden">Silakan pilih semester.</div>
                </div>
                <button type="submit" id="pilih" class="h-10 px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Pilih</button>
            </form>
        </div>
    </div>
    <div id="data-table" class="relative border border-gray-400 overflow-x-auto shadow-md sm:rounded-lg">
        @include('siswa.nilai.table')
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('#filter-form');
        const pilihButton = document.querySelector('#pilih');
        const kelasSelect = document.querySelector('#kelas');
        const semesterSelect = document.querySelector('#semester');
        const kelasError = document.querySelector('#kelas-error');
        const semesterError = document.querySelector('#semester-error');

        pilihButton.addEventListener('click', function(event) {
            let isValid = true;

            // Reset pesan error
            kelasError.classList.add('hidden');
            semesterError.classList.add('hidden');

            // Validasi kelas
            if (!kelasSelect.value) {
                kelasError.classList.remove('hidden');
                isValid = false;
            }

            // Validasi semester
            if (!semesterSelect.value) {
                semesterError.classList.remove('hidden');
                isValid = false;
            }

            // Jika tidak valid, cegah pengiriman form
            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    $(document).ready(function() {
        // Trigger AJAX ketika dropdown berubah
        $('#pilih').on('click', function(event) {
            event.preventDefault();
            // Ambil nilai dari dropdown
            let pilihKelas = $('#kelas').val();
            let pilihSemester = $('#semester').val();

            // Kirim permintaan AJAX
            $.ajax({
                url: "{{ route('siswa.nilai') }}", // URL yang sama
                type: "POST", // Gunakan POST
                data: {
                    _token: "{{ csrf_token() }}", // Sertakan CSRF token
                    pilihKelas: $('#kelas').val(),
                    pilihSemester: $('#semester').val()
                },
                success: function(response) {
                    $('table').html(response);
                },
                error: function(xhr) {
                    console.error("Error occurred:", xhr.responseText);
                }
            });
        });
    });
</script>
@endsection