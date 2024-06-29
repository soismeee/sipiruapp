<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth/login', [
            'title' => 'Login',
        ]);
    }

    public function register(){
        return view('auth.register', [
            'title' => 'Registrasi akun',
        ]);
    }

    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
        [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        return back()->with('loginError', 'Username atau password salah!!!');
    }
    

    public function authenticate2(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => 'Berhasil login']);
        }
        return response()->json(['message' => 'Gagal melakukan authentikasi'], 404);
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $user = new User();
        $user->id = intval((microtime(true) * 10000));
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = 2;
        $user->save();

        return response()->json(['message' => 'Registrasi berhasil dilakukan']);
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
