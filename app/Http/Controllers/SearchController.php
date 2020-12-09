<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Penerbit;
use App\Models\Pengadaan;
use App\Models\Pengunjung;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_absen(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Absen::where('tanggal', 'LIKE', "%{$search}%")->orWhere('pengunjung_id', 'LIKE', "%{$search}%")->orWhere('tujuan', 'LIKE', "%{$search}%")->paginate(10);
        }
        return view('pages.view-laporan.absen', [
            'items' => $items
        ]);
    }

    public function search_peminjaman(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Peminjaman::where('status', '!=', 'Kembali')->where('pengunjung_id', 'LIKE', "%{$search}%")->paginate(10);
        }
        return view('pages.peminjaman.index', [
            'items' => $items
        ]);
    }

    public function search_pengembalian(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Peminjaman::where('status', '=', 'Kembali')->where('pengunjung_id', 'LIKE', "%{$search}%")->paginate(10);
        }
        return view('pages.pengembalian.index', [
            'items' => $items
        ]);
    }

    public function pengunjung(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Pengunjung::where('idPengunjung', 'LIKE', "%{$search}%")->orWhere('nama', 'LIKE', "%{$search}%")->orWhere('no_idt', 'LIKE', "%{$search}%")->orWhere('no_hp', 'LIKE', "%{$search}%")->orWhere('alamat', 'LIKE', "%{$search}%")->paginate(10);
        }
        return view('pages.pengunjung.index', [
            'items' => $items
        ]);
    }

    public function pengadaan(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Pengadaan::join('tb_buku', 'tb_pengadaan.buku_id', '=', 'tb_buku.idBuku')->where('buku_id', 'LIKE', "%{$search}%")->orWhere('asal_buku', 'LIKE', "%{$search}%")->orWhere('judul', 'LIKE', "%{$search}%")->paginate(10);
            return view('pages.pengadaan.index', [
                'items' => $items
            ]);
        }
    }

    public function sirkulasi(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Peminjaman::where('status', '!=', 'Kembali')->where('pengunjung_id', 'LIKE', "%{$search}%")->paginate(10);
        }
        return view('pages.sirkulasi.index', [
            'items' => $items
        ]);
    }

    public function buku(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Buku::join('tb_kategori', 'tb_buku.kategori_id', '=', 'tb_kategori.id')->join('tb_penerbit', 'tb_buku.penerbit_id', '=', 'tb_penerbit.id')->where('idBuku', 'LIKE', "%{$search}%")->orWhere('pengarang', 'LIKE', "%{$search}%")->orWhere('thn_terbit', 'LIKE', "%{$search}%")->orWhere('judul', 'LIKE', "%{$search}%")->orWhere('namaKategori', 'LIKE', "%{$search}%")->orWhere('namaPenerbit', 'LIKE', "%{$search}%")->paginate(10);
            return view('pages.buku.index', [
                'items' => $items
            ]);
        }
    }

    public function kategori(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Kategori::where('namaKategori', 'LIKE', "%{$search}%")->paginate(10);
            return view('pages.kategori.index', [
                'items' => $items
            ]);
        }
    }

    public function penerbit(Request $request)
    {        
        $search = $request->search;
        if ($search == null) {
            toast('Masukkan Kata Kunci','warning');
            return redirect()->back();
        } else {
            $items = Penerbit::where('namaPenerbit', 'LIKE', "%{$search}%")->paginate(10);
            return view('pages.penerbit.index', [
                'items' => $items
            ]);
        }
    }

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
}
