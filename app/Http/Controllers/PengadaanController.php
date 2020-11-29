<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengadaan;
use App\Models\Buku;
use App\Http\Requests\PengadaanRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Pengadaan::with(['buku'])->paginate(10);
        return view('pages.pengadaan.index', [
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
        $bukus = Buku::all();
        return view('pages.pengadaan.create', [
            'bukus' => $bukus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengadaanRequest $request)
    {
        $data = $request -> all();

        $id = $request->get('buku_id');
        $check = Pengadaan::where('buku_id', '=', $id)->first();

        if($check === null) {
            $user = Buku::findOrFail($id);
            $user->stok = $data['jml_masuk'];
            $user->save();
            Pengadaan::create($data);
            Alert::success('Sukses', 'Berhasil Menambahkan Data');
            return redirect() -> route('data-pengadaan.index');
        }else {
            Alert::error('Gagal Menambah Data', 'Judul Buku Sudah Ada');
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
        $item = Pengadaan::findOrFail($id);
        $bukus = Buku::all();
        return view('pages.pengadaan.edit', [
            'item' => $item, 'bukus' => $bukus
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengadaanRequest $request, $id)
    {
        $data = $request->all();
        $item = Pengadaan::findOrFail($id);

        $buku_id = $item-> buku_id;
        $buku_id2 = $request->get('buku_id');
        $check = Pengadaan::where('buku_id', '=', $buku_id)->first();

        if ($check === null || (strtolower($buku_id) == strtolower($buku_id2))) {
            $item -> update($data);
            $user = Buku::findOrFail($buku_id2);
            $user->stok = $data['jml_masuk'];
            $user->save();
            Alert::success('Sukses', 'Berhasil Mengubah Data');
            return redirect() -> route('data-pengadaan.index');
        }else {
            Alert::error('Gagal Mengubah Data', 'Judul Buku Sudah Ada');
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
        $item = Pengadaan::findOrFail($id);
        $item->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Data');
        return redirect() -> route('data-pengadaan.index');
    }
}
