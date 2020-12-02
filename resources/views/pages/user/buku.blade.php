@extends('layouts.home')

@section('title')
    <title>Home | Daftar Buku</title>
@endsection

@section('content')
    <main>
        <div class="container mt-5 mb-3">
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
        <div class="d-flex justify-content-center">
            {!! $items->links() !!}
        </div>
    </main>
@endsection