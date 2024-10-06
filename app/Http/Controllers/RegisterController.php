<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('register.register',[
            'title' => 'Registrasi'
        ]);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required | max:225',
            'username' => ['required', 'min:5', 'max:225', 'unique:users'],
            'email' => 'required | email:dns | unique:users',
            'password' => 'required | min:8 | max:225'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        
        User::create($validateData);
        
        // $request -> session() -> flash('succes', 'Registration succesfull! Please Login');
        return redirect('/login') -> with ('succes', 'Registration succesfull! Please Login') ;
    }
}
