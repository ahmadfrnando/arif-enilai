<table class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3">
                No
            </th>
            <th class="px-6 py-3">
                Mata pelajaran
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
        </tr>
    </thead>
    <tbody id="table-body">
        @if($mapel->isEmpty())
        <tr>
            <td colspan="7" class="px-6 py-4 text-center text-gray-500 space-y-4">
                <img src="{{ asset('images/ill_select.svg') }}" class="mx-auto mt-4" width="300" alt="">
                <h1 class="text-xl font-bold mt-4">Belum memilih kelas dan semester</h1>
            </td>
        </tr>
        @endif
        @foreach($mapel as $key => $m)
        <tr class="odd:bg-white even:bg-gray-50 border-b">
            <td class="px-6 py-4">
                {{ $loop->iteration }}
            </td>
            <td class="px-6 py-4">
                {{ $m->nama_mapel_lengkap }}
            </td>
            <td class="px-6 py-4">
                {{ $m->kkm }}
            </td>
            <td class="px-6 py-4">
                {{ $m->nilaiPengetahuan->nilai_pengetahuan ?? '-' }}
            </td>
            <td class="px-6 py-4">
                {{ $m->nilaiPengetahuan->predikat ?? '-' }}
            </td>
            <td class="px-6 py-4">
                {{ $m->nilaiKeterampilan->nilai_keterampilan ?? '-' }}
            </td>
            <td class="px-6 py-4">
                {{ $m->nilaiKeterampilan->predikat ?? '-' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>