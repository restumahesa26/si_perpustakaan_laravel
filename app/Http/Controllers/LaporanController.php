<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Buku;
use App\Models\Pengadaan;
use App\Models\Pengunjung;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use PDF;

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
        return $pdf->download('laporan-buku.pdf');
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
        return $pdf->download('laporan-anggota.pdf');
    }

    public function viewPengadaan()
    {
        $items = Pengadaan::all();
        return view('pages.view-laporan.pengadaan', [
            'items' => $items
        ]);
    }

    public function pengadaan() 
    {
        $items = Pengadaan::all();
        $count = $items->count();

        if($count < 1) {
          return redirect()->back()->with('error-kosong1','Error');
        }else {
          $pdf = PDF::loadview('pages.laporan.pengadaan', [
            'items' => $items
          ])->setPaper('legal','landscape');
          return $pdf->download('laporan-pengadaan-buku.pdf');
        }
    }

    public function pengadaan2(Request $request) 
    {
      $tgl1 = $request->get('tgl1');
      $tgl2 = $request->get('tgl2');

      if($tgl1 > $tgl2 || $tgl1 == null || $tgl2 == null) {
        return redirect()->back()->with('error-tanggal','Error');
      }else {
        $item = Pengadaan::all();
        $items = $item->whereBetween('tanggal', [$tgl1, $tgl2]);
        $count = $items->count();

        if($count < 1) {
          return redirect()->back()->with('error-kosong','Error');
        }else {
          $pdf = PDF::loadview('pages.laporan.pengadaan', [
            'items' => $items
          ])->setPaper('legal','landscape');
          return $pdf->download('laporan-pengadaan-buku.pdf');
        }
      }
    }

    public function viewPeminjaman()
    {
        $items = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->get();
        return view('pages.view-laporan.peminjaman', [
            'items' => $items
        ]);
    }

    public function peminjaman() 
    {
        $items = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->get();
        $count = $items->count();

        if($count < 1) {
          return redirect()->back()->with('error-kosong1','Error');
        }else {
          $pdf = PDF::loadview('pages.laporan.peminjaman', [
            'items' => $items
          ])->setPaper('legal','landscape');
          return $pdf->download('laporan-peminjaman-buku.pdf');
        }
    }

    public function peminjaman2(Request $request) 
    {
        $tgl1 = $request->get('tgl1');
        $tgl2 = $request->get('tgl2');

        if($tgl1 > $tgl2 || $tgl1 == null || $tgl2 == null) {
          return redirect()->back()->with('error-tanggal','Error');
        }else {
          $item = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->get(); 
          $items = $item->whereBetween('tgl_pinjam', [$tgl1, $tgl2]);
          $count = $items->count();

          if($count < 1) {
            return redirect()->back()->with('error-kosong','Error');
          }else {
            $pdf = PDF::loadview('pages.laporan.peminjaman', [
              'items' => $items
            ])->setPaper('legal','landscape');
            return $pdf->download('laporan-peminjaman-buku.pdf');
          }
        }
    }

    public function viewPengembalian()
    {
        $items = Peminjaman::where('status', '=', 'Kembali')->get();
        return view('pages.view-laporan.pengembalian', [
            'items' => $items
        ]);
    }

    public function pengembalian() 
    {
        $items = Peminjaman::where('status', '=', 'Kembali')->get();
        $count = $items->count();

        if($count < 1) {
          return redirect()->back()->with('error-kosong1','Error');
        }else {
          $pdf = PDF::loadview('pages.laporan.pengembalian', [
            'items' => $items
          ])->setPaper('legal','landscape');
          return $pdf->download('laporan-pengembalian-buku.pdf');
        }
    }

    public function pengembalian2(Request $request) 
    {
        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;

        if($tgl1 > $tgl2 || $tgl1 == null || $tgl2 == null) {
          return redirect()->back()->with('error-tanggal','Error');
        }else {
          $item = Peminjaman::where('status', '=', 'Kembali')->get(); 
          $items = $item->whereBetween('tgl_pinjam', [$tgl1, $tgl2]);
          $count = $items->count();

          if($count < 1) {
            return redirect()->back()->with('error-kosong','Error');
          }else {
            $pdf = PDF::loadview('pages.laporan.pengembalian', [
              'items' => $items
            ])->setPaper('legal','landscape');
            return $pdf->download('laporan-pengembalian-buku.pdf');
          }
        }
    }

    public function viewSirkulasi()
    {
        $items = Peminjaman::all();
        return view('pages.view-laporan.sirkulasi', [
            'items' => $items
        ]);
    }

    public function sirkulasi() 
    {
        $items = Peminjaman::all();
        $count = $items->count();

        if($count < 1) {
          return redirect()->back()->with('error-kosong1','Error');
        }else {
          $pdf = PDF::loadview('pages.laporan.sirkulasi', [
            'items' => $items
          ])->setPaper('legal','landscape');
          return $pdf->download('laporan-peminjaman-pengembalian-buku.pdf');
        }
    }

    public function sirkulasi2(Request $request) 
    {
        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;

        if($tgl1 > $tgl2 || $tgl1 == null || $tgl2 == null) {
          return redirect()->back()->with('error-tanggal','Error');
        }else {
          $item = Peminjaman::all(); 
          $items = $item->whereBetween('tgl_pinjam', [$tgl1, $tgl2]);
          $count = $items->count();

          if($count < 1) {
            return redirect()->back()->with('error-kosong','Error');
          }else {
            $pdf = PDF::loadview('pages.laporan.sirkulasi', [
              'items' => $items
            ])->setPaper('legal','landscape');
            return $pdf->download('laporan-peminjaman-pengembalian-buku.pdf');
          }
        }
    }

    public function viewAbsen()
    {
        $items = Absen::orderByRaw('tanggal DESC')->paginate(10);
        return view('pages.view-laporan.absen', [
            'items' => $items
        ]);
    }

    public function absen() 
    {
        $items = Absen::all();
        $count = $items->count();

        if($count < 1) {
          return redirect()->back()->with('error-kosong1','Error');
        }else {
          $pdf = PDF::loadview('pages.laporan.absen', [
            'items' => $items
          ])->setPaper('legal','landscape');
          return $pdf->download('laporan-absen-kunjungan.pdf');
        }
    }

    public function absen2(Request $request) 
    {
        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;

        if($tgl1 > $tgl2 || $tgl1 == null || $tgl2 == null) {
          return redirect()->back()->with('error-tanggal','Error');
        }else {
          $item = Absen::all(); 
          $items = $item->whereBetween('tanggal', [$tgl1, $tgl2]);
          $count = $items->count();

          if($count < 1) {
            return redirect()->back()->with('error-kosong','Error');
          }else {
            $pdf = PDF::loadview('pages.laporan.absen', [
              'items' => $items
            ])->setPaper('legal','landscape');
            return $pdf->download('laporan-absen-kunjungan.pdf');
          }
        }
    }
}
