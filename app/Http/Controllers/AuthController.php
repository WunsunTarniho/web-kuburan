<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Berhasil Login !');
        }

        return back()
            ->with('fail', 'Email dan Password anda salah !')
            ->withInput();
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/login')->with('success', 'Berhasil Logout !');
    }
}