<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        $this->login_page();
    }

    public function login_page()
    {
        return view('guest.login', ['title' => 'Login Page']);
    }
    public function register_page()
    {
        return view('guest.register', ['title' => 'Register Page']);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6|max:20',
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->with('failed', 'Oops! Percobaan login gagal. Mohon periksa kembali username dan password yang Anda masukkan!');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:30',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users|min:5|max:20',
            'password' => 'required|min:6|max:20',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $query = User::create($validatedData);

        if ($query) {
            return redirect('/auth/login')->with('message', 'Registrasi berhasil!');
        } else {
            return redirect('/auth/login')->with('message', 'Registrasi gagal dilakukan!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login')->with('message', 'Anda telah melakukan logout!');
    }
}
