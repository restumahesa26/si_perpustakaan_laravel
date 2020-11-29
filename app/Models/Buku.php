<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Buku extends Model
{
    use HasFactory;

    public $table = "tb_buku";

    protected $primaryKey = 'idBuku';

    protected $fillable = [
        'idBuku', 'kategori_id', 'penerbit_id', 'judul', 'isbn', 'pengarang', 'halaman', 'stok', 'thn_terbit', 
        'scan'
    ];

    protected $keyType = 'string';

    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id','kategori_id');
    }
    public function penerbit()
    {
        return $this->hasOne(Penerbit::class, 'id','penerbit_id');
    }
    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'idBuku','buku_id');
    }
    public function buku_peminjam()
    {
        return $this->belongsTo(BukuPeminjam::class, 'idBuku','buku_idBuku');
    }
    public function peminjaman() 
    {
        return $this->belongsToMany(Peminjaman::class, 'tb_peminjam_buku');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($peminjaman) { // before delete() method call this
            $peminjaman->peminjaman()->detach();
        });
    }
}
