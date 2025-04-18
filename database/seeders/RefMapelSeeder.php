<?php

namespace Database\Seeders;

use App\Models\RefMapel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefMapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $mapel = [
            'AGAMA',
            'PKN',
            'B.INDO',
            'MM WAJIB',
            'SEJ.INDO',
            'B.ING',
            'S.BUD',
            'PENJAS',
            'PRAKRY',
            'MM MINAT',
            'FISIKA',
            'KIMIA',
            'BIOLOGI',
            'SOSIOLOGI',
        ];

        $mapel_lengkap = [
            'Pendidikan Agama dan Budi Pekerti',
            'Pendidikan Pancasila dan Kewarganegaraan',
            'Bahasa Indonesia',
            'Matematika',
            'Sejarah Indonesia',
            'Bahasa Inggris',
            'Seni Budaya',
            'Pendidikan Jasmani, olahraga, dan kesehatan',
            'Prakarya dan Kewirausahaan',
            'Matematika',
            'Fisika',
            'Kimia',
            'Biologi',
            'Sosiologi',
        ];

        $id = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14
        ];

        $kkm = [
            82,
            82,
            82,
            78,
            82,
            82,
            82,
            82,
            82,
            78,
            78,
            78,
            78,
            82,
        ];

        $data = array_map(function ($mapel, $kkm, $id, $mapel_lengkap) {
            return [
                'id' => $id,
                'nama_mapel' => $mapel,
                'nama_mapel_lengkap' => $mapel_lengkap,
                'kkm' => $kkm,
            ];
        }, $mapel, $kkm, $id, $mapel_lengkap);

        RefMapel::insert($data);
    }
}
