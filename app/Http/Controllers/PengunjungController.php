<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Http\Requests\PengunjungRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Peminjaman;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PDF;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Pengunjung::paginate(10);
        return view('pages.pengunjung.index', [
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
        return view('pages.pengunjung.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengunjungRequest $request)
    {
        $data = $request->all();

        $no_idt = $request->no_idt;
        $check = Pengunjung::where('no_idt', '=', $no_idt)->first();
        $id = IdGenerator::generate(['table' => 'tb_pengunjung','field'=>'idPengunjung', 'length' => 9, 'prefix' =>'AG-']);
        
        if ($check === null) {
            Pengunjung::insert([
                'idPengunjung' => $id,
                'no_idt' => $data['no_idt'],
                'nama' => $data['nama'], 
                'password' => $data['password'],
                'jk' => $data['jk'], 
                'no_hp' => $data['no_hp'],   
                'alamat' => $data['alamat']        
            ]);
            Alert::success('Sukses', 'Berhasil Menambahkan Data Pengunjung');
            return redirect() -> route('data-pengunjung.index');
        }else {
            Alert::error('Gagal Menambah Data', 'No Identitas Sudah Terdaftar');
            return redirect()->back()->withInput();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Pengunjung::findOrFail($id);
        return view('pages.pengunjung.edit', [
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
    public function update(PengunjungRequest $request, $id)
    {
        $data = $request -> all();
        $item = Pengunjung::findOrFail($id);

        $no_idt2 = $item->no_idt;
        $no_idt = $request->no_idt;
        $check = Pengunjung::where('no_idt', '=', $no_idt)->first();

        if ($check === null || (strtolower($no_idt) == strtolower($no_idt2))) {
            $item -> update($data);
            Alert::success('Sukses', 'Berhasil Mengubah Data Pengunjung');
            return redirect() -> route('data-pengunjung.index');
        }else {
            Alert::error('Gagal Menambah Data', 'No Identitas Sudah Terdaftar');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pengunjung::findOrFail($id);
        $id = $item->pengunjung_id;

        $data = Peminjaman::where('pengunjung_id', '=', $id)->where('status', '=', 'Pinjam')->orWhere('status', '=', 'Perpanjang')->orWhere('status', '=', 'Kembali')->first();
        
        if ($data === null) {
            $item->delete();
            Alert::success('Sukses', 'Berhasil Menghapus Data Pengunjung');
            return redirect() -> route('data-pengunjung.index');
        }else {
            Alert::error('Gagal Menghapus Data', 'Pengunjung Sudah Pernah Meminjam Buku');
            return redirect() -> route('data-pengunjung.index');
        }
    }

    public function printCard($id)
    {
        $item = Pengunjung::findOrFail($id);
    
        return view('pages.user.card', [
            'item'=> $item
        ]);
    }
}
