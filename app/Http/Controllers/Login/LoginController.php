<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function SignIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember == 'on' ? true : false)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Verifique que sus datos sean correctos.',
        ])->onlyInput('email');
    }

    public function Signup(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
