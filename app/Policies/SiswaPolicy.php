<?php

namespace App\Policies;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiswaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Siswa $siswa)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Siswa $siswa)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Siswa $siswa)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Siswa $siswa)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Siswa $siswa)
    {
        return true;
    }
}
