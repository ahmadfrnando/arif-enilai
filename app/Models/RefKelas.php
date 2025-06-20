<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefKelas extends Model
{
    use HasFactory;

    protected $table = 'ref_kelas';

    protected $fillable = [
        'nama_kelas',
        'jumlah_siswa',
    ];

    public function jumlahSiswa()
    {
        return Siswa::where('id_kelas_sekarang', $this->id)->count();
    }
}
