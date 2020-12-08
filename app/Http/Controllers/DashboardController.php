<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengunjung;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjam = Pengunjung::all()->count();
        $buku = Buku::all()->count();
        $peminjaman = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->count();
        $pengembalian = Peminjaman::where('status', '=', 'Kembali')->count();
        $tgl = Carbon::now();
        $tgl2 = $tgl->toDateString();
        $absen = Absen::where('tanggal', '=', $tgl2)->count();
        $transaksi = Peminjaman::where('status', 'Pinjam')->orWhere('status', 'Perpanjang')->orWhere('status', 'Kembali')->where('updated_at', '=', $tgl)->count();
        return view('pages.dashboard', [
            'peminjam' => $peminjam, 'buku' => $buku, 'peminjaman' => $peminjaman, 'pengembalian' => $pengembalian, 'absen' => $absen, 'transaksi' => $transaksi
        ]);
    }
}
