<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    public $table = "tb_absen";

    protected $fillable = [
        'id', 'tanggal', 'pengunjung_id', 'tujuan'
    ];

    public function pengunjung()
    {
        return $this->hasOne(Pengunjung::class, 'idPengunjung', 'pengunjung_id');
    }
}
