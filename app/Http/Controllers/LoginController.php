<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(){
        return view('login.login',[
            'title' => 'Login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request -> validate([
            'email' => 'required | email',
            'password' => 'required | min:8'
        ]);
        Log::info('Credentials:', $credentials);
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
        return redirect('/login');
    }
}
