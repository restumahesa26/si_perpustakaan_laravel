<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePeminjamBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_peminjam_buku', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('peminjaman_idPeminjaman')->length(10); 
            $table->string('buku_idBuku', 10);
            $table->foreign('peminjaman_idPeminjaman')->references('idPeminjaman')->on('tb_sirkulasis');
            $table->foreign('buku_idBuku')->references('idBuku')->on('tb_buku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_peminjam_buku');
    }
}
