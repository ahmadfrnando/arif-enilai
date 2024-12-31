<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $guarded =[];


    protected static function boot()
    {
        parent::boot();

        // Event created: dijalankan setelah data siswa ditambahkan
        static::created(function ($guru) {
            User::create([
                'name' => $guru->nama_guru,
                'email' => $guru->email,
                'id_guru' => $guru->id,
                'role' => 'guru',
                'password' => Hash::make('123'), // Password default
            ]);
        });

        static::updated(function ($guru) {
            $user = User::where('id_guru', $guru->id)->first();
            if ($user) {
                $user->update([
                    'name' => $guru->nama_guru,
                    'email' => $guru->email,
                ]);
            }
        });

        static::deleted(function ($guru) {
            $user = User::where('id_guru', $guru->id)->first();
            if ($user) {
                $user->delete();
            }
        });
    }

    public function mapel()
    {
        return $this->belongsTo(RefMapel::class, 'id_mapel', 'id');
    }
}
