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
        $mapels = [
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

        $data = array_map(function ($mapel, $kkm) {
            return [
                'nama_mapel' => $mapel,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'kkm' => $kkm,
            ];
        }, $mapels);

        RefMapel::insert($data);
    }
}
