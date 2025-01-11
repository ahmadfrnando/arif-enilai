<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaLulusMapel extends Model
{
    use HasFactory;

    protected $table = 'siswa_lulus_mapel';

    protected $guarded = [];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(RefMapel::class, 'id_mapel', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(RefKelas::class, 'id_kelas', 'id');
    }
}
