<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\KategoriRequest;
use App\Models\Buku;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Kategori::paginate(10);
        return view('pages.kategori.index', [
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
        return view('pages.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {
        $data = $request -> all(); 

        $kategori = $request->get('namaKategori');
        $check = Kategori::where('namaKategori', '=', $kategori)->first();

        if($check === null) {
            Kategori::create($data);
            return redirect() -> route('data-kategori.index')-> with('success-tambah','Sukses');
        }else {
            return redirect()->back()->withInput()-> with('error-tambah','Gagal');
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
        $item = Kategori::findOrFail($id);
        return view('pages.kategori.edit', [
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
    public function update(KategoriRequest $request, $id)
    {
        $data = $request -> all();
        $item = Kategori::findOrFail($id);

        $kategori2 = $item-> namaKategori;
        $kategori = $request->get('namaKategori');
        $check = Kategori::where('namaKategori', '=', $kategori)->first();

        if($check === null || strtolower($kategori) == strtolower($kategori2)) {
            $item -> update($data);
            return redirect() -> route('data-kategori.index')-> with('success-ubah','Sukses');
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
        $item = Kategori::findOrFail($id);
        $id = $item->id;

        $data = Buku::where('kategori_id', '=', $id)->first();
        
        if ($data === null) {
            $item->delete();
            return redirect() -> back() -> with('success-hapus','Berhasil');
        }else {
            return redirect() -> back() -> with('error-hapus','Gagal');
        }
    }
}
