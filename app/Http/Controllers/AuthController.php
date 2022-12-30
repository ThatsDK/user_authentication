<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
    ]);

    if(Auth::attempt($request->only('email', 'password'))){
        return redirect('home');
    }

    return redirect('login')->withError('Login Details are invalid');

    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:4',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            return redirect('home');
        }

        return redirect('register')->withError('Error');
    }

    public function home(){
        return view('auth.home');
    }

    public function logout(){
        \Session::flush();
        Auth::logout();
        return redirect('');
    }
}
