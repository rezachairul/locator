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
        $credentials = $request -> validate([
            'email' => 'required | email',
            'password' => 'required | min:8'
        ]);
        Log::info('Attempting login for:', ['email' => $credentials['email']]);
        if(Auth::attempt($credentials)){
            $request -> session() -> regenerate();
            return redirect() -> intended('/dashboard');
        }

        Log::warning('Login failed for user: ' . $credentials['email']);
        return back()->with('loginError', 'Login Failed!');
    }

    public function logout()
    {
        Auth::logout();
        request() -> session() -> invalidate();
        request() -> session() -> regenerateToken();
        return redirect('/auth/login');
    }
}
