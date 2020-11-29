<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    public $table = "tb_pengunjung";

    protected $primaryKey = 'idPengunjung';

    protected $fillable = [
        'idPengunjung', 'no_idt', 'nama', 'jk', 'no_hp', 'alamat', 'password'
    ];
    protected $keyType = 'string';
    
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'idPengunjung', 'pengunjung_id');
    }
    public function absen()
    {
        return $this->belongsTo(Absen::class, 'idPengunjung', 'pengunjung_id');
    }
}
