<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on user role
            switch ($user->role) {
                case 'guru':
                    return redirect()->route('guru.dashboard');
                case 'siswa':
                    return redirect()->route('siswa.dashboard');
                case 'kepsek':
                    return redirect()->route('kepsek.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['email' => 'Role not recognized.']);
            }
        }

        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ]);
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
