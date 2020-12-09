<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use App\Http\Requests\PenerbitRequest;
use App\Models\Buku;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Penerbit::paginate(10);
        return view('pages.penerbit.index', [
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
        return view('pages.penerbit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenerbitRequest $request)
    {
        $data = $request -> all(); 

        $penerbit = $request->get('namaPenerbit');
        $check = Penerbit::where('namaPenerbit', '=', $penerbit)->first();

        if($check === null) {
            Penerbit::create($data);
            return redirect() -> route('data-penerbit.index') -> with('success-tambah','Sukses');
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
        $item = Penerbit::findOrFail($id);
        return view('pages.penerbit.edit', [
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
    public function update(PenerbitRequest $request, $id)
    {
        $data = $request -> all();
        $item = Penerbit::findOrFail($id);

        $penerbit2 = $item-> namaPenerbit;
        $penerbit = $request->get('namaPenerbit');
        $check = Penerbit::where('namaPenerbit', '=', $penerbit)->first();

        if($check === null || strtolower($penerbit) == strtolower($penerbit2)) {
            $item -> update($data);
            return redirect() -> route('data-penerbit.index') -> with('success-ubah','Sukses');
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
        $item = Penerbit::findOrFail($id);
        $id = $item->id;

        $data = Buku::where('penerbit_id', '=', $id)->first();
        
        if ($data === null) {
            $item->delete();
            return redirect() -> back() -> with('success-hapus','Berhasil');
        }else {
            return redirect() -> back() -> with('error-hapus','Gagal');
        }
    }

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
}
