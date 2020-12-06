<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pengunjung;

class APIController extends Controller
{
    public function buku_pengadaan($id)
    {
        $data = Buku::with('penerbit')->findOrFail($id);
        return response()->json($data);
    }

    
    public function anggota($id)
    {
        $data = Pengunjung::findOrFail($id);
        return response()->json($data);
    }

    public function cekNoIdentitas(Request $request) 
    {
      $data = $request->no_idt;
      $check = Pengunjung::where('no_idt', '=', $data)->first();
      if($check != null){
        return response()->json("gagal");
      }else {
        return response()->json("berhasil");
      }
    }

    public function cekID(Request $request) 
    {
      $data = $request->id_anggota;
      $check = Pengunjung::where('idPengunjung', '=', $data)->first();
      if($check != null){
        return response()->json("berhasil");
      }else {
        return response()->json("gagal");
      }
    }
}
