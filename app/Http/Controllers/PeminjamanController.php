<?php

namespace App\Http\Controllers;

use App\Models\JadwalAula;
use App\Models\Klien;
use App\Models\Peminjaman;
use App\Models\PinjamFasilitas;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(){
        return view('peminjaman.index', [
            'title' => 'Peminjaman',
            'menu' => 'Peminjaman',
            'submenu' => 'Daftar'
        ]);
    }

    public function getPeminjaman(){
        $role = auth()->user()->role;
        $peminjaman = Peminjaman::with(['jadwal_aula', 'pinjam_fasilitas'])->select('*');
        if ($role == 2) {
            $klien = Klien::where('user_id', auth()->user()->id)->first();
            $peminjaman->where('klien_id', $klien->id);
        } else{
            $peminjaman->where('status_peminjaman', '!=', 'Selesai');
        }

        if ($peminjaman->count() > 0) {
            return response()->json(['data' => $peminjaman->get()]);
        } else {
            return response()->json(['message' => 'Belum ada pengajuan peminjaman'], 404);
        }
        
    }

    public function create(){
        $peminjaman = Peminjaman::where('tanggal', '>=', date('Y-m-d'))->pluck('tanggal');
        $data_peminjaman = Peminjaman::with(['jadwal_aula'])->where('tanggal', '>=', date('Y-m-d'))->orderBy('ja_id', 'asc')->orderBy('tanggal', 'asc')->get();
        return view('peminjaman.create', [
            'title' => 'Buat Peminjaman',
            'menu' => 'Peminjaman',
           'submenu' => 'Create',
           'jadwal' => JadwalAula::all(),
           'klien' =>Klien::where('user_id', auth()->user()->id)->first(),
           'tanggal' => $peminjaman,
           'data_peminjaman' => $data_peminjaman,
        ]);
    }

    public function riwayat(){
        return view('peminjaman.riwayat', [
            'title' => 'Peminjaman',
            'menu' => 'Riwayat Pinjam',
            'submenu' => 'Riwayat'
        ]);
    }

    public function cekPeminjaman($id){
        $peminjaman = Peminjaman::where('tanggal', '>=', date('Y-m-d'))->where('ja_id', $id)->pluck('tanggal');
        return response()->json($peminjaman);

    }

    public function jsonRiwayat()
    {
        $columns = ['id', 'klien_id', 'ja_id', 'nama_peminjam', 'waktu_awal', 'waktu_akhir', 'tanggal', 'keperluan', 'status_peminjaman'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = Peminjaman::with(['jadwal_aula', 'klien'])->select('id', 'klien_id', 'nama_peminjam', 'ja_id', 'waktu_awal', 'waktu_akhir', 'tanggal', 'keperluan', 'status_peminjaman')->where('status_peminjaman', 'Selesai')->orderBy('id', 'DESC');

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('id like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('tanggal like ? ', ['%' . request()->input("search.value")])
                    ->orWhereRaw('keperluan like ? ', ['%' . request()->input("search.value")]);
            });
        }

        if(request('tanggal') !== null){
            $data = $data->where('tanggal', request('tanggal'));
        }

        $recordsFiltered = $data->get()->count();
        if (request()->input('length') == -1) {
            $data = $data->orderBy($orderBy, request()->input("order.0.dir"))->get();
        } else {
            $data = $data->skip(request()->input('start'))->take(request()->input('length'))->orderBy($orderBy, request()->input("order.0.dir"))->get();
        }
        $recordsTotal = $data->count();

        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'tanggal' => request('tanggal')
        ]);
    }

    public function kodePeminjaman()
    {
        $jmldatahariini = Peminjaman::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->whereDate('created_at', date('Y-m-d'))->first();
        return "SPR" . date("ymd") . $jmldatahariini['kodes'];
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'ja_id' => 'required',
            'nama_peminjam' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'alamat_kantor' => 'required',
            'tanggal' => 'required',
            'keperluan' => 'required',
            'bentuk_ruang' => 'required',
            'surat_pinjam' => 'required',
        ]);

        $surat = $request->file('surat_pinjam');
        $nama_surat = time().'.'.$surat->getClientOriginalExtension();
        $destinasiFolder = public_path('/surat');
        $surat->move($destinasiFolder, $nama_surat);

        $jadwalaula = JadwalAula::find($request->ja_id);

        $peminjaman = new Peminjaman();
        $peminjaman->id = $this->kodePeminjaman();
        $peminjaman->klien_id = $request->klien_id;
        $peminjaman->ja_id = $request->ja_id;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->no_telepon = $request->no_telepon;
        $peminjaman->alamat = $request->alamat;
        $peminjaman->alamat_kantor = $request->alamat_kantor;
        $peminjaman->tanggal = $request->tanggal;
        $peminjaman->waktu_awal = $jadwalaula->sesi_awal;
        $peminjaman->waktu_akhir = $jadwalaula->sesi_akhir;
        $peminjaman->bentuk_ruang = $request->bentuk_ruang;
        $peminjaman->surat_pinjam = $nama_surat;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->status_peminjaman = "Pengajuan";
        $peminjaman->save();
        // dd($peminjaman);

        foreach ($request->fasilitas as $key => $fasilitas) {
            PinjamFasilitas::create([
                'peminjaman_id' => $peminjaman->id,
                'fasilitas' => $request->fasilitas[$key],
                'qty' => $request->qty[$key]
            ]);
        }

        return redirect('/p');
    }

    public function  prosesStatus(Request $request, $id){
        try {
            $getPeminjaman = Peminjaman::findOrFail($id);
            $getPeminjaman->status_peminjaman = $request->status_peminjaman;
            $getPeminjaman->update();
            return response()->json(['message' => 'Data berhasil diproses']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data tidak berhasil diproses'], 404);
        }
    }

    public function destroy($id){
        Peminjaman::destroy($id);
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
