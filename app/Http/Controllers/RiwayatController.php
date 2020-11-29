<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Carbon;

class RiwayatController extends Controller
{
    public function index1() 
    {
        $items = Peminjaman::where('status', '=', 'Kembali')->paginate(10);
        return view('pages.pengembalian.index', [
            'items' => $items
        ]);
    }

    public function show1($id) 
    {
        $item = Peminjaman::findOrFail($id);
        return view('pages.pengembalian.show', [
            'item' => $item
        ]);
    }

    public function index2() 
    {
        $items = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->paginate(10);
        return view('pages.peminjaman.index', [
            'items' => $items
        ]);
    }

    public function show2($id) 
    {
        $item = Peminjaman::findOrFail($id);
        return view('pages.peminjaman.show', [
            'item' => $item
        ]);
    }
}
