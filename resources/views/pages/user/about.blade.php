@extends('layouts.home')

@section('title')
    <title>Home | About Us</title>
@endsection

@section('content')
    <main>
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h4>ABOUT US</h4>
                </div>
                <div class="col-md-8 text-justify">
                  &emsp;&emsp;Pada sistem informasi ini, terdapat 3 jenis pengguna yang dapat mengakses sistem informasi perpustakaan daerah yang dibuat diantaranya <br> <br>
                  <ul>
                    <li>Pada pengunjung dapat melakukan aktivitas pengisian absen kunjungan, pada aktivitas ini pengunjung memasukkan id anggota dan password yang sebelumnya sudah terdaftar pada sistem informasi perpustakaan daerah ini. Dan apabila pengunjung belum terdaftar maka pengunjung dapat melakukan registrasi terlebih dahulu di halaman daftar anggota dengan memasukkan nama, password, no identitas, jenis kelamin, nomor telepon, dan alamat. Pengunjung juga dapat melihat daftar buku yang tersedia dalam web yang disediakan.</li> <br>
                    <li>Pada admin/staff dapat mengelola manajemen buku, manajemen anggota, manajemen transaksi peminjaman, manajemen kategori dan penerbit, manajemen data staff serta manajemen laporan. Untuk mengakses manajemen admin/staff harus login terlebih dahulu. Pada manajemen buku, admin/staff dapat melihat serta melakukan aktivitas penambahan, pengubahan, serta penghapusan data buku. Pada manajemen anggota, admin/staff dapat melihat serta melakukan aktivitas penambahan, pengubahan, serta penghapusan data anggota. Pada manajemen transaksi peminjaman, admin/staff dapat melihat serta melakukan aktivitas penambahan, perpanjangan, pengembalian, serta penghapusan data peminjaman. Pada manajemen kategori dan penerbit, admin/staff dapat melihat serta melakukan aktivitas penambahan, pengubahan, serta penghapusan data kategori atau penerbit. Pada manajemen data staff, admin/staff dapat melihat serta melakukan aktivitas penambahan, pengubahan, serta penghapusan data staff. Dan terakhir pada manajemen laporan, admin/staff dapat melihat serta melakukan aktivitas pembuatan data laporan.</li>
                  </ul>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-12 text-center">
                    <h4>ANGGOTA TIM KELOMPOK 1</h4>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-6 about-opacity py-2">
                    <img src="{{ url('frontend/images/image-2.jpg') }}" alt="" class="about-img rounded-circle">
                    <div class="clear-2"></div>
                    <div class="text-desc">
                        <h5 class="text-primary">Mufti Restu Mahesa</h5>
                        <p>G1A019014</p>
                        <p class="text-justify">Pada Tugas Akhir Basis Data ini, saya bertugas sebagai Programmer. Yaitu orang yang bertanggung
                            jawab terhadap seluruh kodingan mulai dari frontend dan backend</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-6 about-opacity py-2">
                    <img src="{{ url('frontend/images/image-1.jpg') }}" alt="" class="about-img rounded-circle">
                    <div class="clear-2"></div>
                    <div class="text-desc">
                        <h5 class="text-primary">Norizam Age Pratama</h5>
                        <p>G1A018088</p>
                        <p class="text-justify">Pada Tugas Akhir Basis Data ini, saya bertugas sebagai Desainer dan Insert Data. Yaitu orang yang bertanggung
                            jawab terhadap desain dari website tersebut dan juga bertanggung jawab terhadap data</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-6 about-opacity py-2">
                    <img src="{{ url('frontend/images/image-1.jpg') }}" alt="" class="about-img rounded-circle">
                    <div class="clear-2"></div>
                    <div class="text-desc">
                        <h5 class="text-primary">Hendra Yesekyel Pangaribuan</h5>
                        <p>G1A019072</p>
                        <p class="text-justify">Pada Tugas Akhir Basis Data ini, saya bertugas sebagai Desainer dan Insert Data. Yaitu orang yang bertanggung
                          jawab terhadap desain dari website tersebut dan juga bertanggung jawab terhadap data</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-6 about-opacity py-2">
                    <img src="{{ url('frontend/images/image.jpg') }}" alt="" class="about-img rounded-circle">
                    <div class="clear-2"></div>
                    <div class="text-desc">
                        <h5 class="text-primary">Diyah Ishita Azzahrah</h5>
                        <p>G1A019038</p>
                        <p class="text-justify">Pada Tugas Akhir Basis Data ini, saya bertugas Membuat Laporan. Yaitu orang yang bertanggung
                            jawab terhadap laporan dari sistem informasi perpustakaan</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-6 about-opacity py-2">
                    <img src="{{ url('frontend/images/image.jpg') }}" alt="" class="about-img rounded-circle">
                    <div class="clear-2"></div>
                    <div class="text-desc">
                        <h5 class="text-primary">Nabilatul Balqis</h5>
                        <p>G1A019074</p>
                        <p class="text-justify">Pada Tugas Akhir Basis Data ini, saya bertugas Membuat Laporan. Yaitu orang yang bertanggung
                          jawab terhadap laporan dari sistem informasi perpustakaan</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection