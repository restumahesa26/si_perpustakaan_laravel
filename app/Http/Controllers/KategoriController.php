<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Requests\KategoriRequest;
use RealRashid\SweetAlert\Facades\Alert;


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
            Alert::success('Sukses', 'Berhasil Menambahkan Data Kategori');
            return redirect() -> route('data-kategori.index');
        }else {
            Alert::error('Gagal Menambah Data', 'Nama Kategori Sudah Ada');
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
            Alert::success('Sukses', 'Berhasil Mengubah Data Kategori');
            return redirect() -> route('data-kategori.index');
        }else {
            Alert::error('Gagal Mengubah Data', 'Nama Kategori Sudah Ada');
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
        $item = Kategori::findOrFail($id);

        $item->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data');
        
        return redirect() -> route('data-kategori.index');
    }
}
