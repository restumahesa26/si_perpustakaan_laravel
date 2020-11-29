@extends('layouts.home')

@section('title')
    <title>Home</title>
@endsection

@section('content')
<header class="text-center">
    <img src="{{ url('frontend/images/logo.png') }}" class="logo-center" id="img-header">
    <h2 class="judul-header" id="judul-header">SISTEM INFORMASI PERPUSTAKAAN <br> DINAS PERPUSTAKAAN & KEARSIPAN PROV. BENGKULU</h2>
    <a href="{{ route('kunjungan')}}" class="btn btn-absen">Isi Kunjungan</a>
</header>

<main>
    <div class="container">
        <h3 class="text-center mt-3">
            INFORMASI
        </h3>
        <div class="row justify-content-between info">
            <div class="col-md-4 text-center info-opacity" id="buku-info">
                <i class="fa fa-book buku-img-info pt-2"></i>
                <h1>Buku</h1>
                <h2>{{ $buku }}+</h2>
            </div>
            <div class="col-md-4 text-center info-opacity" id="anggota-info">
                <i class="fa fa-id-card buku-img-info pt-2"></i>
                <h1>Anggota</h1>
                <h2>{{ $anggota }}+</h2>
            </div>
            <div class="col-md-4 text-center info-opacity" id="pengunjung-info">
                <i class="fa fa-users buku-img-info pt-2"></i>
                <h1>Pengunjung</h1>
                <h2>{{ $pengunjung }}</h2>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-between mb-2">
            <h3 class="ml-3">Buku Terpopuler</h3>
            <p><a href="{{ route('buku') }}" class="btn btn-outline-success mr-3">View All <i class="fa fa-arrow-right"></i> </a></p>
        </div>
        <div class="row justify-content-center daftar-buku" id="daftar-buku">
            @foreach ($items as $item)
                <div class="col-md-3 card-buku">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('storage/images/scan-cover-buku/'. $item-> scan) }}" class="buku-img" alt="...">
                        </div>
                        <h5 class="card-title text-center">{{ $item->judul }}</h5>
                        <span>Halaman : {{ $item->halaman }} <br></span>
                        <span>Pengarang : {{ $item->pengarang }} <br></span>
                        <span>Penerbit : {{ $item->penerbit->namaPenerbit }} <br></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="section-carousel">
            <h3 class="text-center">Foto Ruang</h3>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ url('frontend/images/gambar-1.png') }}" class="d-block w-100 carousel-image" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('frontend/images/gambar-2.png') }}" class="d-block w-100 carousel-image" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('frontend/images/gambar-3.png') }}" class="d-block w-100 carousel-image" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('frontend/images/gambar-4.png') }}" class="d-block w-100 carousel-image" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('frontend/images/gambar-5.png') }}" class="d-block w-100 carousel-image" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection