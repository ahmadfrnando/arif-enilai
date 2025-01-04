<?php

namespace App\Exports;

use App\Models\ReportAkademikSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportAkademikExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ReportAkademikSiswa::all();
    }
}
