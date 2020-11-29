<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Http\Requests\PengunjungRequest;
use App\Models\Absen;
use App\Models\Pengunjung;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $buku = Buku::count() - 1;
        $anggota = Pengunjung::count() -1;
        $items = Buku::paginate(4);
        $tgl1 = Carbon::now();
        $tgl = $tgl1->toDateString();
        $pengunjung = Absen::where('tanggal', '=', $tgl)->count();
        return view('pages.user.home', [
            'items' => $items, 'buku' => $buku, 'anggota' => $anggota, 'pengunjung' => $pengunjung
        ]);
    }
    public function buku()
    {
        $items = Buku::paginate(20);
        return view('pages.user.buku', [
            'items' => $items
        ]);
    }
    public function about()
    {
        return view('pages.user.about');
    }
    public function kunjungan()
    {
        $pengunjungs = Pengunjung::select('idPengunjung')->get();
        return view('pages.user.kunjungan', [
            'pengunjungs' => $pengunjungs
        ]);
    }
    public function daftar()
    {
        return view('pages.user.daftar');
    }
    

    public function tambahAnggota(PengunjungRequest $request)
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
            Alert::success('Sukses', 'Berhasil Daftar Sebagai Anggota');
            return redirect() -> route('kunjungan');
        }else {
            Alert::error('Gagal Menambah Data', 'No Identitas Sudah Terdaftar');
            return redirect()->back()->withInput();
        }
    }

    public function absen(Request $request) 
    {
        $id = $request->pengunjung_id;
        $pass = $request->password;
        $tujuan = $request->tujuan;

        $tgl = Carbon::now();
        $tgl2 = Carbon::now();
        $tg = $tgl2->toDateString();

        $check = Pengunjung::where('idPengunjung', '=', $id)->where('password', '=', $pass)->first();
        $check2 = Absen::where('tanggal', '=', $tg)->where('pengunjung_id', '=', $id)->first();

        if ($check != null) {
            if ($check2 === null) {
                Absen::create([
                    'pengunjung_id' => $id, 
                    'tanggal' => $tgl, 
                    'tujuan' => $tujuan
                ]);
                Alert::success('Berhasil', 'Terimakasih Telah Mengisi Kunjungan');
                return redirect()->route('home');
            }else {
                Alert::error('Gagal', 'Tidak Boleh Mengabsen 2x');
                return redirect()->back();
            }
        }else{
            Alert::error('Gagal', 'ID dan Password Tidak Cocok');
            return redirect()->back();
        }
    }
}
