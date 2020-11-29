@extends('layouts.dashboard')

@section('title')
    <title>Admin | Tambah Kategori</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-kategori.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-2">Tambah Data Kategori</h1>
        </div>

        @if ($errors->count() > 0)
            @php
            Alert::error('Gagal Mengubah Data', 'Masih Terdapat Data Belum Valid');
            @endphp
        @endif

        <div class="card-show">
                <div class="card-body">
                    <form action="{{ route('data-kategori.store') }}" method="POST" class="form" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="namaKategori">Kategori</label>
                            <input id="namaKategori" type="text" class="form-control @error('namaKategori') is-invalid @enderror" name="namaKategori" placeholder="Nama Kategori" value="{{ old('namaKategori') }}">
                            @error('namaKategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
    </div>
</div>


@endsection
