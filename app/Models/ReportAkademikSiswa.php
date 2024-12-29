<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAkademikSiswa extends Model
{
    use HasFactory;

    protected $table = 'report_akademik_siswa';

    protected $guarded = [];

    protected $casts = [
        'nilai' => 'array', // Kolom 'nilai' akan otomatis di-cast ke array PHP
    ];

    public function kelas()
    {
        return $this->belongsTo(RefKelas::class, 'id_kelas', 'id');
    }
}
