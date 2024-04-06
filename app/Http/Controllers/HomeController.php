<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        $id = auth()->user()->id;
        $klien = Klien::where('user_id', $id)->first();
        if($role == 2 && $klien == null){
            return redirect('/lengkapidata');
        }
        $view = 'home.user.index';
        if ($role == 1) {
            $view = 'home.dinas.index';
        }
        return view($view, [
            'title' => 'Halaman utama',
            'menu' => 'Dashboard',
            'submenu' => 'Halaman utama'
        ]);
    }

    public function lengkapiData(){
        return view('home.user.firstpage', ['title' => 'Lengkapi data']);
    }

    public function profile()
    {
        return view('layout.profil', [
            'title' => 'Profil',
            'menu' => 'Dashboard',
            'submenu' => 'Profil',
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'no_telepon' => 'required',
            'alamat' => 'required',
            'alamat_kantor' => 'required',
        ]);

        $klien = new Klien();
        $klien->id = intval((microtime(true) * 10000));
        $klien->user_id = auth()->user()->id;
        $klien->nama_klien = auth()->user()->name;
        $klien->no_telepon = $request->no_telepon;
        $klien->alamat = $request->alamat;
        $klien->alamat_kantor = $request->alamat_kantor;
        $klien->save();

        return redirect('/');
    }

    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $name = $request->name;
        
        $user = User::find($id);
        $dbname = $user->name;
        
        if ($name == $dbname) {
            return redirect('/profile')->with('error', 'Data tidak ada yang berubah');
        }else{
            $rules = $request->validate([
                'name' => 'required|max:255',
            ]);

            if ($request->password !== null) {
                $rules['password'] = Hash::make($request->password);
            }

            User::where('id', $id)->update($rules);
            Auth::logout();

            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/login')->with('success', 'Data pengguna berhasil diubah');
        }
    }

    public function informasiAula(){
        return view('informasi_aula.index', [
            'title' => 'Informasi Aula',
            'menu' => 'Informasi Aula',
           'submenu' => 'Aula'
        ]);
    }


    public function laporan(){
        return view('laporan.index', [
            'title' => 'Laporan',
            'menu' => 'Laporan Pinjam',
            'submenu' => 'Daftar'
        ]);
    }
}
