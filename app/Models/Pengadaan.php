<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    public $table = "tb_pengadaan";

    protected $primaryKey = 'idPengadaan';

    protected $fillable = [
        'idPengadaan', 'buku_id', 'asal_buku', 'jml_masuk', 'keterangan', 'tanggal'
    ];

    public function buku()
    {
        return $this->hasOne(Buku::class, 'idBuku','buku_id');
    }
}
