<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
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
    
    public function riwayat(){
        return view('peminjaman.riwayat', [
            'title' => 'Peminjaman',
            'menu' => 'Riwayat Pinjam',
            'submenu' => 'Riwayat'
        ]);
    }

    public function create(){
        return view('peminjaman.create', [
            'title' => 'Buat Peminjaman',
            'menu' => 'Peminjaman',
           'submenu' => 'Create'
        ]);
    }

    public function jsonRiwayat()
    {
        $columns = ['id', 'klien_id', 'ja_id', 'waktu_awal', 'waktu_akhir', 'tanggal', 'keperluan'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = Peminjaman::select('id', 'klien_id', 'ja_id', 'waktu_awal', 'waktu_akhir', 'tanggal', 'keperluan')->orderBy('id', 'DESC');

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('id like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('tanggal like ? ', ['%' . request()->input("search.value")])
                    ->orWhereRaw('keperluan like ? ', ['%' . request()->input("search.value")]);
            });
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
            'data' => $data
        ]);
    }
}
