<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public $table = "tb_kategori";

    protected $fillable = [
        'id', 'namaKategori'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id','kategori_id');
    }
}
