<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login kustom
    public function showLoginForm()
    {
        return view('auth.login'); // Blade login kustommu
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/adminybm'); // redirect ke dashboard Filament
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // Logout
    public function logout(Request $request)
{
    Auth::logout(); // pakai guard default 'web'
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/adminybm/login');
}

}
