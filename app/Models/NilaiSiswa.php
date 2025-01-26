<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $table = 'nilai_siswa';
    protected $guarded = [];


    public static function calculatePredikatPengetahuan($kkm, $nilai_pengetahuan)
    {
        if ($kkm == 78) {
            if ($nilai_pengetahuan < 78) {
                return 'D';
            } elseif ($nilai_pengetahuan >= 78 && $nilai_pengetahuan <= 79) {
                return 'C';
            } elseif ($nilai_pengetahuan >= 80 && $nilai_pengetahuan <= 89) {
                return 'B';
            } elseif ($nilai_pengetahuan >= 90 && $nilai_pengetahuan <= 100) {
                return 'A';
            }
        } elseif ($kkm == 82) {
            if ($nilai_pengetahuan < 82) {
                return 'D';
            } elseif ($nilai_pengetahuan >= 82 && $nilai_pengetahuan <= 83) {
                return 'C';
            } elseif ($nilai_pengetahuan >= 84 && $nilai_pengetahuan <= 89) {
                return 'B';
            } elseif ($nilai_pengetahuan >= 90 && $nilai_pengetahuan <= 100) {
                return 'A';
            }
        }
        return null; // Default jika tidak ada kriteria
    }
    public static function calculatePredikatKeterampilan($kkm, $nilai_keterampilan)
    {
        if ($kkm == 78) {
            if ($nilai_keterampilan < 78) {
                return 'D';
            } elseif ($nilai_keterampilan >= 78 && $nilai_keterampilan <= 79) {
                return 'C';
            } elseif ($nilai_keterampilan >= 80 && $nilai_keterampilan <= 89) {
                return 'B';
            } elseif ($nilai_keterampilan >= 90 && $nilai_keterampilan <= 100) {
                return 'A';
            }
        } elseif ($kkm == 82) {
            if ($nilai_keterampilan < 82) {
                return 'D';
            } elseif ($nilai_keterampilan >= 82 && $nilai_keterampilan <= 83) {
                return 'C';
            } elseif ($nilai_keterampilan >= 84 && $nilai_keterampilan <= 89) {
                return 'B';
            } elseif ($nilai_keterampilan >= 90 && $nilai_keterampilan <= 100) {
                return 'A';
            }
        }
        return null; // Default jika tidak ada kriteria
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function mapel()
    {
        return $this->belongsTo(RefMapel::class, 'id_mapel');
    }
    public function kelas()
    {
        return $this->belongsTo(RefKelas::class, 'id_kelas');
    }
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($nilaiPengetahuan) {
    //         $mapel = RefMapel::find($nilaiPengetahuan->id_mapel);
    //         if ($mapel) {
    //             $nilaiPengetahuan->predikat = self::calculatePredikat($mapel->kkm, $nilaiPengetahuan->nilai_pengetahuan);
    //         }
    //     });

    //     static::updating(function ($nilaiPengetahuan) {
    //         $mapel = RefMapel::find($nilaiPengetahuan->id_mapel);
    //         if ($mapel) {
    //             $nilaiPengetahuan->predikat = self::calculatePredikat($mapel->kkm, $nilaiPengetahuan->nilai_pengetahuan);
    //         }
    //     });
    // }

    public function status()
    {
        return $this->belongsTo(RefStatusLulus::class, 'status_lulus_mapel', 'id');
    }
}
