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
}
