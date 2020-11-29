<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuPeminjam extends Model
{
    use HasFactory;

    public $table = "tb_peminjam_buku";

    protected $fillable = [
        'peminjaman_idPeminjaman', 'buku_idBuku'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_idPeminjaman','idPeminjaman');
    }

    public function buku()
    {
        return $this->hasMany(Buku::class, 'idBuku','buku_idBuku');
    }
}
