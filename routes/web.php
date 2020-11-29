<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('/daftar-buku', 'HomeController@buku')->name('buku');

Route::get('/about-us', 'HomeController@about')->name('about-us');

Route::get('/isi-kunjungan', 'HomeController@kunjungan')->name('kunjungan');

Route::get('/daftar-anggota', 'HomeController@daftar')->name('daftar');

Route::get('/absen', 'HomeController@absen')->name('absen');

Route::get('/daftar-sebagai-anggota', 'HomeController@tambahAnggota')->name('daftar-anggota');

Auth::routes(['verify' => true]);
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/absen-pengunjung/search', 'SearchController@search_absen')->name('search-absen');

        Route::get('/riwayat-peminjaman/search', 'SearchController@search_peminjaman')->name('search-peminjaman');

        Route::get('/riwayat-pengembalian/search', 'SearchController@search_pengembalian')->name('search-pengembalian');

        Route::get('/data-pengunjung/search', 'SearchController@pengunjung')->name('search-pengunjung');

        Route::get('/data-pengadaan/search', 'SearchController@pengadaan')->name('search-pengadaan');

        Route::get('/data-peminjaman/search', 'SearchController@sirkulasi')->name('search-sirkulasi');

        Route::get('/data-buku/search', 'SearchController@buku')->name('search-buku');
        
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::get('/pengadaan/{id}', 'APIController@buku_pengadaan')->name('pengadaan-buku');

        Route::get('/anggota/{id}', 'APIController@anggota')->name('api-anggota');

        Route::get('/cari', 'APIController@loadData')->name('cari');

        Route::get('/data-staf', 'ProfileController@index')->name('staf.index');

        Route::get('/data-staf/{id}/edit', 'ProfileController@edit')->name('staf.edit');

        Route::put('/data-staf/{id}/edit', 'ProfileController@update')->name('staf.update');

        Route::delete('/data-staf/{id}/delete', 'ProfileController@destroy')->name('staf.destroy');

        Route::resource('data-kategori', 'KategoriController');

        Route::resource('data-penerbit', 'PenerbitController');

        Route::resource('data-buku', 'BukuController');

        Route::resource('data-pengunjung', 'PengunjungController');

        Route::get('/data-pengunjung/{data_pengunjung}/cetak-kartu', 'PengunjungController@printCard')->name('printCard');

        Route::resource('data-pengadaan', 'PengadaanController');

        Route::put('/data-peminjaman/{data_peminjaman}/perpanjang', 'PeminjamanController@perpanjang')->name('data-peminjaman.perpanjang');

        Route::get('/data-peminjaman/{data_peminjaman}/denda', 'PeminjamanController@hitung_denda')->name('data-peminjaman.denda');

        Route::get('/data-peminjaman/{data_peminjaman}/kembali', 'PeminjamanController@kembali')->name('data-peminjaman.kembali');

        Route::put('/data-peminjaman/{data_peminjaman}/pengembalian', 'PeminjamanController@pengembalian')->name('data-peminjaman.pengembalian');

        Route::resource('data-peminjaman', 'PeminjamanController');

        Route::get('/riwayat-pengembalian', 'RiwayatController@index1')->name('riwayat-pengembalian');

        Route::get('/riwayat-pengembalian/{id}/show/pengembalian', 'RiwayatController@show1')->name('riwayat-pengembalian.show');

        Route::get('/riwayat-peminjaman', 'RiwayatController@index2')->name('riwayat-peminjaman');

        Route::get('/riwayat-peminjaman/{id}/show/peminjaman', 'RiwayatController@show2')->name('riwayat-peminjaman.show');
    
        Route::get('/laporan-buku', 'LaporanController@viewBuku')->name('viewBuku');

        Route::get('/cetak-laporan-buku', 'LaporanController@buku')->name('printBuku');

        Route::get('/laporan-anggota', 'LaporanController@viewPengunjung')->name('viewPengunjung');

        Route::get('/cetak-laporan-anggota', 'LaporanController@pengunjung')->name('printPengunjung');

        Route::get('/laporan-pengadaan-buku', 'LaporanController@viewPengadaan')->name('viewPengadaan');

        Route::get('/cetak-laporan-pengadaan-buku', 'LaporanController@pengadaan')->name('printPengadaan'); 

        Route::get('/laporan-peminjaman', 'LaporanController@viewPeminjaman')->name('viewPeminjaman');

        Route::get('/cetak-laporan-peminjaman', 'LaporanController@peminjaman')->name('printPeminjaman'); 

        Route::get('/cetak-laporan-peminjaman-tanggal', 'LaporanController@peminjaman2')->name('printPeminjaman2');

        Route::get('/laporan-pengembalian', 'LaporanController@viewPengembalian')->name('viewPengembalian');

        Route::get('/cetak-laporan-pengembalian', 'LaporanController@pengembalian')->name('printPengembalian');
        
        Route::get('/cetak-laporan-pengembalian-tanggal', 'LaporanController@pengembalian2')->name('printPengembalian2'); 

        Route::get('/laporan-peminjaman-dan-pengembalian', 'LaporanController@viewSirkulasi')->name('viewSirkulasi');

        Route::get('/cetak-laporan-peminjaman-dan-pengembalian', 'LaporanController@sirkulasi')->name('printSirkulasi');
        
        Route::get('/cetak-laporan-peminjaman-dan-pengembalian-tanggal', 'LaporanController@sirkulasi2')->name('printSirkulasi2');

        Route::get('/absen-pengunjung', 'LaporanController@viewAbsen')->name('viewAbsen');

        Route::get('/cetak-laporan-absen-dan-kunjungan', 'LaporanController@absen')->name('printAbsen');
        
        Route::get('/cetak-laporan-absen-dan-kunjungan-tanggal', 'LaporanController@absen2')->name('printAbsen2');

    }); 
Auth::routes(['verify' => true]);