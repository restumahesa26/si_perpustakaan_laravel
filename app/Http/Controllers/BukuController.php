<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Buku;
use App\Http\Requests\BukuRequest;
use App\Models\BukuPeminjam;
use App\Models\Pengadaan;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Buku::with(['kategori', 'penerbit'])->paginate(10);
        return view('pages.buku.index', [
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
        $items = Kategori::orderByRaw('namaKategori ASC')->get();
        $items2 = Penerbit::orderByRaw('namaPenerbit ASC')->get();
        return view('pages.buku.create', [
            'items' => $items, 'items2' => $items2
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BukuRequest $request)
    {
        $data = $request -> all(); 

        $judul = $request->judul;
        $pengarang = $request->pengarang;
        $penerbit = $request->penerbit_id;
        $check = Buku::where('judul', '=', $judul)->where('pengarang', '=', $pengarang)->where('penerbit_id', '=', $penerbit)->first();
        $file = $request->file('scan');
        $id = IdGenerator::generate(['table' => 'tb_buku','field'=>'idBuku', 'length' => 9, 'prefix' =>'BK-']);
        
        if($check === null) {
            
            if ($request->has('scan')) {
                $extension = $file->extension();
                $imageNames = uniqid('img_', microtime()).'.'.$extension;
                Storage::putFileAs('public/images/scan-cover-buku', $file, $imageNames);
                $thumbnailpath = public_path('storage/images/scan-cover-buku/'.$imageNames);
                $img = Image::make($thumbnailpath)->resize(400, 600)->save($thumbnailpath);
            } else {
              return redirect()->back()->withInput()->with('error-image','Error');
            }

            Buku::insert([
                'idBuku' => $id,
                'judul' => $data['judul'],
                'kategori_id' => $data['kategori_id'],
                'penerbit_id' => $data['penerbit_id'],
                'isbn' => $data['isbn'],
                'pengarang' => $data['pengarang'],
                'halaman' => $data['halaman'],
                'stok' => $data['stok'],
                'thn_terbit' => $data['thn_terbit'],
                'scan' => $imageNames
            ]);
            return redirect() -> route('data-buku.index') -> with('success-tambah','Sukses');
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
        $item = Buku::findOrFail($id);
        $items = Kategori::orderByRaw('namaKategori ASC')->get();
        $items2 = Penerbit::orderByRaw('namaPenerbit ASC')->get();
        return view('pages.buku.edit', [
            'item' => $item, 'items' => $items, 'items2' => $items2
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BukuRequest $request, $id)
    {
        $data = $request -> only(['judul', 'kategori_id','penerbit_id','isbn','pengarang','halaman','thn_terbit','scan','stok']);
        $item = Buku::findOrFail($id);

        $judul = $item->judul;
        $pengarang = $item->pengarang;
        $penerbit = $item->penerbit_id;
        $pengarang2 = $request->pengarang;
        $penerbit2 = $request->penerbit_id;
        $judul2 = $request->judul;
        $check = Buku::where('judul', '=', $judul2)->where('pengarang', '=', $pengarang2)->where('penerbit_id', '=', $penerbit2)->first();

        if ($check === null || (strtolower($judul) == strtolower($judul2) && strtolower($pengarang) == strtolower($pengarang2) && strtolower($penerbit) == strtolower($penerbit2))) {
            $imageName = null;
            $filename  = ('public/images/scan-cover-buku/').$item-> scan;
            $file = $request->file('scan');
    
            if ($request->has('scan')) {
                $extension = $file->extension();
                $imageNames = uniqid('img_', microtime()).'.'.$extension;
                Storage::delete($filename);
                Storage::putFileAs('public/images/scan-cover-buku', $file, $imageNames);
                $imageName = $imageNames;
                $thumbnailpath = public_path('storage/images/scan-cover-buku/'.$imageNames);
                $img = Image::make($thumbnailpath)->resize(400, 600)->save($thumbnailpath);
            }else{
                $namaFile = $item-> scan;
                $imageName = $namaFile;
            }
    
            $item -> update([
                'judul' => $data['judul'],
                'kategori_id' => $data['kategori_id'],
                'penerbit_id' => $data['penerbit_id'],
                'isbn' => $data['isbn'],
                'pengarang' => $data['pengarang'],
                'halaman' => $data['halaman'],
                'stok' => $data['stok'],
                'thn_terbit' => $data['thn_terbit'],
                'scan' => $imageName
            ]);
            return redirect() -> route('data-buku.index') -> with('success-ubah','Sukses');
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
        $item = Buku::findOrFail($id);

        $data = Pengadaan::where('buku_id', '=', $id)->first();
        $data2 = BukuPeminjam::where('buku_idBuku', '=', $id)->first();
        
        if ($data === null && $data2 === null) {
            $item->delete();
            return redirect() -> route('data-buku.index') -> with('success-hapus','Berhasil');
        }else {
            return redirect() -> route('data-buku.index') -> with('error-hapus','Gagal');
        }
    }

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
}
