<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Peminjaman;
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
        $test = Peminjaman::with(['jadwal_aula'])->where('tanggal', '>=', date('Y-m-d'))->get();
        $view = 'home.user.index';
        if ($role == 1) {
            $view = 'home.dinas.index';
        }
        return view($view, [
            'title' => 'Halaman utama',
            'menu' => 'Dashboard',
            'submenu' => 'Halaman utama',
            'test' => $test,
            'pengajuan' => Peminjaman::where('status_peminjaman', 'Pengajuan')->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->count(),
            'proses' => Peminjaman::where('status_peminjaman', 'Proses')->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->count(),
            'selesai' => Peminjaman::where('status_peminjaman', 'Selesai')->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->count(),
            'peminjaman' => Peminjaman::where('status_peminjaman', 'Proses')->whereYear('tanggal', date('Y'))->get()    
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
        $aula = [
            'meja_depan' => 1,
            'podium' => 1,
            'meja_panjang' => 4,
            'kursi' => 100,
            'proyektor' => 2,
            'smart_tv' => 1,
            'lcd' => 1,
            'audio' => 4

        ];
        return view('informasi_aula.index', [
            'title' => 'Informasi Aula',
            'menu' => 'Informasi Aula',
            'submenu' => 'Aula',
            'aula' => $aula
        ]);
    }


    public function laporan(){
        return view('laporan.index', [
            'title' => 'Laporan',
            'menu' => 'Laporan Pinjam',
            'submenu' => 'Daftar'
        ]);
    }

    public function dataLaporan($request)
    {
        $request->validate(
            ['range_tanggal' => 'required'],
            ['range_tanggal.required' => 'Rentang tanggal harus dipilih']
        );
        $tanggal = $request->range_tanggal;
        $awal = mb_substr($tanggal, 0, 10);
        $akhir = mb_substr($tanggal, 14, 24);
        if ($akhir == null) {
            $peminjaman = Peminjaman::with(['jadwal_aula', 'klien'])->where('tanggal', $awal);
        } else {
            $peminjaman = Peminjaman::with(['jadwal_aula', 'klien'])->whereBetween('tanggal', [$awal, $akhir]);
        }

        $tgl = date('d/m/Y', strtotime($awal)) . " s.d " . date('d/m/Y', strtotime($akhir));
        $data = ['peminjaman' => $peminjaman, 'tanggal' => $tgl];
        return $data;
    }

    public function getLaporan(Request $request){
        $data = $this->dataLaporan($request);
        $peminjaman = $data['peminjaman'];
        if ($peminjaman->count() > 0) {
            return response()->json(['data' => $peminjaman->get()]);
        } else {
            return response()->json(['message' => "Tidak ada data di rentang tanggal ini."], 404);
        }
        
    }

    public function cetakLaporan(Request $request){
        $data = $this->dataLaporan($request);
        $peminjaman = $data['peminjaman'];
        $tanggal = $data['tanggal'];
        return view('laporan.cetak', [
            'title' => 'Cetak Data Peminjaman',
            'peminjaman' => $peminjaman->get(),
            'tanggal' => $tanggal
        ]);
    }
}
