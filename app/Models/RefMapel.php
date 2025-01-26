<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefMapel extends Model
{
    use HasFactory;

    protected $table = 'ref_mapel';
    // protected $guarded = [];
    protected $fillable = [
        'id',
        'nama_mapel',
        'nama_mapel_lengkap',
        'kkm'
    ];

    public function nilai()
    {
        return $this->hasOne(NilaiSiswa::class, 'id_mapel', 'id');
    }

    public function siswaLulusMapel()
    {
        return $this->hasMany(SiswaLulusMapel::class, 'id_mapel', 'id');
    }
}
