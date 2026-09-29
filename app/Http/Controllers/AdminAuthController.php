<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau kata laluan tidak sah.',
                ])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        // Pastikan hanya user dengan role admin boleh masuk.
        if (Auth::user()->role !== 'admin') {
            Auth::logout();

            return back()
                ->withErrors([
                    'email' => 'Akaun ini tidak mempunyai akses Admin.',
                ])
                ->withInput($request->only('email'));
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}