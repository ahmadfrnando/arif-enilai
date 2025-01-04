<?php

namespace App\Exports;

use App\Models\ReportAkademikSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Contracts\View\View;

class ReportAkademikExport implements FromView, WithStyles, WithDrawings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $student;
    protected $grades;

    public function __construct($student, $grades)
    {
        $this->student = $student;
        $this->grades = $grades;
    }

    public function view(): View
    {
        return view('siswa.exports.report-akademik-siswa', [
            'student' => $this->student,
            'grades' => $this->grades,
        ]);
    }

    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        return [
            // Format Heading
            'A1:Z1' => ['font' => ['bold' => true]],
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Student Photo');
        $drawing->setDescription('Photo of the student');
        // $drawing->setPath(public_path('images/students/' . $this->student->photo)); // Path ke foto siswa
        $drawing->setHeight(100);
        $drawing->setCoordinates('A1');

        return [$drawing];
    }
}
