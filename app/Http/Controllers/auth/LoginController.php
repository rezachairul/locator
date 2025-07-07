<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login.login',[
            'title' => 'Login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $role = $request->input('role');

        if ($role == 'admin') {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            if (Auth::attempt(array_merge($credentials, ['role' => 'admin']))) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            return back()->with('loginError', 'Email atau password salah!');
        }

        if ($role == 'operator') {
            $credentials = $request->validate([
                'username' => 'required',
            ]);

            if (Auth::attempt(['username' => $credentials['username'], 'role' => 'operator'])) {
                $request->session()->regenerate();
                return redirect()->route('operator.dashboard');
            }
            return back()->with('loginError', 'Username salah atau tidak terdaftar!');
        }

        return back()->with('loginError', 'Role tidak dikenali!');
    }

    public function logout()
    {
        Auth::logout();
        request() -> session() -> invalidate();
        request() -> session() -> regenerateToken();
        return redirect('/auth/login');
    }
}
