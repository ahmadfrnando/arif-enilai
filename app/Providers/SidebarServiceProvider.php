<?php

namespace App\Providers;

use App\Models\WaliKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('guru.partials.sidebar', function ($view) {
            $user = Auth::user()->id_guru; // Get the authenticated user
            $isWaliKelas = WaliKelas::where('id_guru', $user)->exists(); // Check if the user is a WaliKelas

            $view->with('isWaliKelas', $isWaliKelas);
        });
    }
}
