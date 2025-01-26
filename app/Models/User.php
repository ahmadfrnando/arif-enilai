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
        return str_ends_with($this->email, 'admin@gmail.com');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto',
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
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event created: dijalankan setelah data siswa ditambahkan
        static::updated(function ($user) {
            if ($user->role == 'siswa') {
                $siswa = Siswa::where('id', $user->id_siswa)->first();
                $siswa->update([
                    'nama_siswa' => $user->name,
                    'email' => $user->email
                ]);
            }
            if ($user->role == 'guru') {
                $guru = Guru::where('id', $user->id_guru)->first();
                $guru->update([
                    'nama_guru' => $user->name,
                    'email' => $user->email
                ]);
            }
        });
    }
}
