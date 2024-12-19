<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $guarded = [];

    public function kelas_pertama()
    {
        return $this->belongsTo(RefKelas::class, 'id_kelas_pertama', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(RefKelas::class, 'id_kelas_sekarang', 'id');
    }

    public function nilaiPengetahuan()
    {
        return $this->belongsTo(NilaiPengetahuan::class, 'id', 'id_siswa');
    }
    public function nilaiKeterampilan()
    {
        return $this->belongsTo(NilaiKeterampilan::class, 'id', 'id_siswa');
    }
}
