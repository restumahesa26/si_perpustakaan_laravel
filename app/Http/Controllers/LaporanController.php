<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Buku;
use App\Models\Pengadaan;
use App\Models\Pengunjung;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
{
    public function viewBuku()
    {
        $items = Buku::all();
        toast('Menu untuk laporan buku','info');
        return view('pages.view-laporan.buku', [
            'items' => $items
        ]);
    }

    public function buku() 
    {
        $items = Buku::all();

        $pdf = PDF::loadview('pages.laporan.buku', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-buku');
    }

    public function viewPengunjung()
    {
        $items = Pengunjung::all();
        toast('Menu untuk laporan anggota','info');
        return view('pages.view-laporan.pengunjung', [
            'items' => $items
        ]);
    }

    public function pengunjung() 
    {
        $items = Pengunjung::all();

        $pdf = PDF::loadview('pages.laporan.pengunjung', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-anggota');
    }

    public function viewPengadaan()
    {
        $items = Pengadaan::all();
        toast('Menu untuk laporan pengadaan buku','info');
        return view('pages.view-laporan.pengadaan', [
            'items' => $items
        ]);
    }

    public function pengadaan() 
    {
        $items = Pengadaan::all();

        $pdf = PDF::loadview('pages.laporan.pengadaan', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-pengadaan-buku');
    }

    public function viewPeminjaman()
    {
        $items = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->get();
        toast('Menu untuk laporan peminjaman buku','info');
        return view('pages.view-laporan.peminjaman', [
            'items' => $items
        ]);
    }

    public function peminjaman() 
    {
        $items = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->get();

        $pdf = PDF::loadview('pages.laporan.peminjaman', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-peminjaman-buku');
    }

    public function peminjaman2(Request $request) 
    {
        $tgl1 = $request->get('tgl1');
        $tgl2 = $request->get('tgl2');

        $item = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->get(); 
        $items = $item->whereBetween('tgl_pinjam', [$tgl1, $tgl2]);

        $pdf = PDF::loadview('pages.laporan.peminjaman', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-peminjaman-buku');
    }

    public function viewPengembalian()
    {
        $items = Peminjaman::where('status', '=', 'Kembali')->get();
        toast('Menu untuk laporan pengembalian buku','info');
        return view('pages.view-laporan.pengembalian', [
            'items' => $items
        ]);
    }

    public function pengembalian() 
    {
        $items = Peminjaman::where('status', '=', 'Kembali')->get();

        $pdf = PDF::loadview('pages.laporan.pengembalian', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-pengembalian-buku');
    }

    public function pengembalian2(Request $request) 
    {
        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;
        $item = Peminjaman::where('status', '=', 'Kembali')->get(); 
        $items = $item->whereBetween('tgl_pinjam', [$tgl1, $tgl2]);

        $pdf = PDF::loadview('pages.laporan.pengembalian', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-pengembalian-buku');
    }

    public function viewSirkulasi()
    {
        $items = Peminjaman::all();
        toast('Menu untuk laporan sirkulasi buku','info');
        return view('pages.view-laporan.sirkulasi', [
            'items' => $items
        ]);
    }

    public function sirkulasi() 
    {
        $items = Peminjaman::all();

        $pdf = PDF::loadview('pages.laporan.sirkulasi', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-peminjaman-pengembalian-buku');
    }

    public function sirkulasi2(Request $request) 
    {
        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;
        $item = Peminjaman::all(); 
        $items = $item->whereBetween('tgl_pinjam', [$tgl1, $tgl2]);

        $pdf = PDF::loadview('pages.laporan.sirkulasi', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-peminjaman-pengembalian-buku');
    }

    public function viewAbsen()
    {
        $items = Absen::orderByRaw('tanggal DESC')->paginate(10);
        toast('Menu untuk laporan absen kunjungan','info');
        return view('pages.view-laporan.absen', [
            'items' => $items
        ]);
    }

    public function absen() 
    {
        $items = Absen::all();

        $pdf = PDF::loadview('pages.laporan.absen', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-absen-kunjungan');
    }

    public function absen2(Request $request) 
    {
        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;
        $item = Absen::all(); 
        $items = $item->whereBetween('tanggal', [$tgl1, $tgl2]);

        $pdf = PDF::loadview('pages.laporan.absen', [
            'items' => $items
        ])->setPaper('legal','landscape');
        return $pdf->download('laporan-absen-kunjungan');
    }
}
