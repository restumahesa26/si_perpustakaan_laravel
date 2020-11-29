<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{

    public $table = "tb_sirkulasis";

    protected $primaryKey = 'idPeminjaman';

    protected $fillable = [
        'idPeminjaman', 'pengunjung_id', 'tgl_pinjam', 'tgl_kembali', 'tgl_panjang', 'tgl_pengembalian', 'status', 'denda', 'keterangan'
    ];

    protected $keyType = 'string';
    
    public function pengunjung()
    {
        return $this->hasOne(Pengunjung::class, 'idPengunjung','pengunjung_id');
    }

    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'tb_peminjam_buku');
    }

    public function buku_peminjam()
    {
        return $this->hasMany(BukuPeminjam::class, 'idPeminjaman','peminjaman_idPeminjaman');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($buku) { 
            $buku->buku()->detach();
        });
    }
}
