<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    public $table = "tb_penerbit";

    protected $fillable = [
        'id', 'namaPenerbit'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id','penerbit_id');
    }
}
