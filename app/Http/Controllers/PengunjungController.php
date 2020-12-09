<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Http\Requests\PengunjungRequest;
use App\Models\Peminjaman;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Pengunjung::orderByRaw('nama ASC')->paginate(10);
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
            return redirect() -> route('data-pengunjung.index') -> with('success-tambah','Sukses');
        }else {
            return redirect()->back()->withInput() -> with('error-tambah','Gagal');
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
            return redirect() -> route('data-pengunjung.index') -> with('success-ubah','Sukses');
        }else {
            return redirect()->back()->withInput()->with('error-ubah','Gagal');
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
        $id = $item->idPengunjung;

        $data = Peminjaman::where('pengunjung_id', '=', $id)->first();
        
        if ($data === null) {
            $item->delete();
            return redirect() -> back() -> with('success-hapus','Berhasil');
        }else {
            return redirect() -> back() -> with('error-hapus','Gagal');
        }
    }

    public function printCard($id)
    {
        $item = Pengunjung::findOrFail($id);
    
        return view('pages.user.card', [
            'item'=> $item
        ]);
    }

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
}
