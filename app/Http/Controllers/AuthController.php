<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard()
    {
        if (Auth::check() == true) {
            return view('admin.dashboard');
        }
        return redirect()->route('login');
    }

    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin');
        }
        return redirect()->back()->withInput()->withErrors(['Dados informados incorretos!']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
