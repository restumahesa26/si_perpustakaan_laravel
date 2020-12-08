<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanRequest;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\BukuPeminjam;
use App\Models\Pengunjung;
use Illuminate\Support\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Peminjaman::where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->orderByRaw('updated_at DESC')->paginate(10);
        return view('pages.sirkulasi.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengunjungs = Pengunjung::all();
        $bukus = Buku::where('stok', '>', '0')->orderByRaw('judul ASC')->get();
        return view('pages.sirkulasi.create', [
            'pengunjungs' => $pengunjungs, 'bukus' => $bukus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeminjamanRequest $request)
    {
        $data = $request -> all();

        $id = $request->pengunjung_id;
        $check = Peminjaman::where('pengunjung_id', '=', $id)->where('status', '=', 'Perpanjang')->orWhere('status', '=', 'Pinjam')->count();

        if($check > 3) {
            return redirect()->back()->withInput()->with('error-tambah','error');
        }else {
            $buku = array();

            if($files=$request->buku_id){
                foreach ($files as $file) {
                    $buku[]=$file;
                }
            }
    
            $tglPinjam = Carbon::now();
    
            $tglPinjam2 = Carbon::now();
    
            $tglKembali = $tglPinjam2->addDays(7);
    
            $status = "Pinjam";

            $peminjaman = new Peminjaman;
            $peminjaman->pengunjung_id = $data['pengunjung_id'];
            $peminjaman->tgl_pinjam = $tglPinjam;
            $peminjaman->tgl_kembali = $tglKembali;
            $peminjaman->status = $status;
            $peminjaman->keterangan = $data['keterangan'];
            $peminjaman->save();

            foreach ($buku as $bu) {
                $bukuu = Buku::find($bu);
                $peminjaman->buku()->attach($bukuu);
            }
    
            foreach ($buku as $b) {
                $bu = Buku::findOrFail($b);
                $bu->stok = $bu->stok - 1;
                $bu->save();
            }
            return redirect() -> route('data-peminjaman.index')->with('success-tambah','error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Buku::with('penerbit')->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Peminjaman::findOrFail($id);
        return view('pages.sirkulasi.perpanjang', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeminjamanRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Peminjaman::findOrFail($id);
        $idd = $item->idPeminjaman;

        $buku = array();
        $data = BukuPeminjam::where('peminjaman_idPeminjaman', '=', $idd)->get();
        foreach ($data as $a) {
            $bu = $a->buku_idBuku;
            $buku[] = $bu;
        } 
        foreach ($buku as $aa) {
            $buk = Buku::findOrFail($aa);
            $buk->stok = $buk->stok + 1;
            $buk->save();
        }
        $item->delete();
        
        return redirect() -> route('data-peminjaman.index')-> with('success-hapus','Berhasil');;
    }

    public function kembali($id)
    {
        $item = Peminjaman::findOrFail($id);
        return view('pages.sirkulasi.kembali', [
            'item' => $item
        ]);
    }

    public function perpanjang(Request $request, $id)
    {        
        $item = Peminjaman::findOrFail($id);

        $tgl = Carbon::createFromFormat('Y-m-d', $request->tgl_pinjam);
        $date = $tgl->addDays(7);

        if($item->tgl_pinjam > $request->tgl_pinjam){
            return redirect()->back()->with('error-perpanjang','error');
        }else {
            $start_date = Carbon::createFromFormat('Y-m-d', $request->tgl_pinjam);
            $end_date = Carbon::createFromFormat('Y-m-d', $item->tgl_kembali);

            $denda = $item->denda;
            if($start_date < $end_date){
                $denda3 = 0;
            }else {
                $hari = $end_date->diffInDays($start_date);
                $denda2 = 2000 * $hari;
                $denda3 = $denda + $denda2;
            }

            $status = "Perpanjang";
            $item->tgl_kembali = $date;
            $item->tgl_panjang = $request->tgl_pinjam;
            $item->status = $status;
            $item->denda = $denda3;
            $item->save();
            return redirect() -> route('data-peminjaman.index')->with('success-perpanjang','success');
        }
    }

    public function pengembalian(Request $request, $id)
    {        
        $item = Peminjaman::findOrFail($id);
        $idd = $item->idPeminjaman;

        $tgl = Carbon::createFromFormat('Y-m-d', $request->tgl_pinjam);

        $buku = array();
        $data = BukuPeminjam::where('peminjaman_idPeminjaman', '=', $idd)->get();

        foreach ($data as $a) {
            $bu = $a->buku_idBuku;
            $buku[] = $bu;
        } 

        if($item->tgl_pinjam > $request->tgl_pinjam){
            return redirect()->back()->with('error-pengembalian','error');
        }else {
            foreach ($buku as $aa) {
                $buk = Buku::findOrFail($aa);
                $buk->stok = $buk->stok + 1;
                $buk->save();
            }
            $start_date = Carbon::createFromFormat('Y-m-d', $request->tgl_pinjam);
            $end_date = Carbon::createFromFormat('Y-m-d', $item->tgl_kembali);

            $rusak = 0;
            if($buku_rusak = $request->rusak){
                $rusak = $buku_rusak * 10000;
            }else {
                $rusak = 0;
            }

            $hilang = 0;
            if($buku_hilang = $request->hilang){
                $hilang = $buku_hilang * 50000;
            }else {
                $hilang = 0;
            }

            $denda2 = 0;

            $denda = $item->denda;
            if($start_date < $end_date){
                $denda3 = 0;
                $denda4 = $rusak + $hilang + $denda;
            }else {
                $hari = $end_date->diffInDays($start_date);
                $denda2 = 2000 * $hari;
                $denda3 = $denda + $denda2;
                $denda4 = $rusak + $hilang + $denda3;
            }

            $status = "Kembali";
            $item->tgl_pengembalian = $tgl;
            $item->status = $status;
            $item->denda = $denda4;
            $item->save();
            return redirect() -> route('data-peminjaman.index')->with('success-pengembalian','success');
        }
    }

    public function hitung_denda(Request $request , $id)
    {        
        $item = Peminjaman::findOrFail($id);

        $tgl = $request->tgl_pinjam;

        $start_date = Carbon::createFromFormat('Y-m-d', $tgl);
        $end_date = Carbon::createFromFormat('Y-m-d', $item->tgl_kembali);

        $rusak = 0;
        if($buku_rusak = $request->rusak){
            $rusak = $buku_rusak * 10000;
        }else {
            $rusak = 0;
        }

        $hilang = 0;
        if($buku_hilang = $request->hilang){
            $hilang = $buku_hilang * 50000;
        }else {
            $hilang = 0;
        }

        $denda2 = 0;
        $denda = 0;
        if($start_date < $end_date ){
            $denda = 0;
            $denda2 = $rusak + $hilang + $denda;
        }else {
            $hari = $end_date->diffInDays($start_date);
            $denda = 2000 * $hari;
            $denda2 = $rusak + $hilang + $denda;
        }

        return response()->json(rupiahFormat($denda2));
    }
}
