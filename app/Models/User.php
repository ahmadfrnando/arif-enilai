<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;


class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    public function canAccessFilament(): bool
    {
        return str_ends_with($this->username, 'admin');
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($user) {
            if ($user->id_guru !== null) {
                $guru = Guru::where('id', $user->id_guru)->first();
                if ($guru) {
                    $guru->update([
                        'nama_guru' => $user->name,
                        'username' => $user->username,
                    ]);
                }
            } else if ($user->id_siswa !== null) {
                $siswa = Siswa::where('id', $user->id_siswa)->first();
                if ($siswa) {
                    $siswa->update([
                        'nama_siswa' => $user->name,
                        'username' => $user->username,
                    ]);
                }
            }
        });

        static::deleted(function ($user) {
            if ($user->id_guru !== null) {
                $guru = Guru::where('id', $user->id_guru)->first();
                if ($guru) {
                    $guru->delete();
                }
            } else if ($user->id_siswa !== null) {
                $siswa = Siswa::where('id', $user->id_siswa)->first();
                if ($siswa) {
                    $siswa->delete();
                }
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'id_siswa',
        'id_guru',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
