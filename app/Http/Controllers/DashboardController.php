<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengunjung;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjam = Pengunjung::all()->count();
        $buku = Buku::all()->count();
        $peminjaman = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->count();
        $pengembalian = Peminjaman::where('status', '=', 'Kembali')->count();
        return view('pages.dashboard', [
            'peminjam' => $peminjam, 'buku' => $buku, 'peminjaman' => $peminjaman, 'pengembalian' => $pengembalian
        ]);
    }
}
