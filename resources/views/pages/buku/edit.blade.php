@extends('layouts.dashboard')

@section('title')
    <title>Admin | Edit Buku</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-buku.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-2">Ubah Data Buku</h1>
        </div>

        @if ($errors->count() > 0)
            @php
            Alert::error('Gagal Mengubah Data', 'Masih Terdapat Data Belum Valid');
            @endphp
        @endif

        <div class="card-show">
            <div class="card-body">
                <form action="{{ route('data-buku.update', $item->idBuku) }}" method="POST" class="form" id="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="idBuku">ID Buku</label>
                        <input id="idBuku" type="text" class="form-control @error('idBuku') is-invalid @enderror"
                            name="idBuku" placeholder="ID Buku" value="{{ $item->idBuku }}" readonly>
                        @error('idBuku')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror"
                            name="judul" placeholder="Judul" value="{{ $item->judul }}">
                        @error('judul')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select id="kategori" name="kategori_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($items as $kategori)
                            <option value="{{ $kategori-> id }}" 
                                @if ($kategori-> id === $item->kategori_id)
                                    selected
                                @endif                
                                >
                                {{ $kategori-> namaKategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('kategori')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input id="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror"
                            name="isbn" placeholder="ISBN" value="{{ $item->isbn }}">
                        @error('isbn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input id="pengarang" type="text" class="form-control @error('pengarang') is-invalid @enderror"
                            name="pengarang" placeholder="Pengarang" value="{{ $item->pengarang }}">
                        @error('pengarang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="halaman">Halaman</label>
                        <input id="halaman" type="number" class="form-control @error('halaman') is-invalid @enderror"
                            name="halaman" placeholder="Halaman" value="{{ $item->halaman }}">
                        @error('halaman')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" placeholder="Stok" value="{{ $item->stok }}">
                        @error('stok')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thn_terbit">Tahun Terbit</label>
                        <input id="thn_terbit" type="text"
                            class="form-control @error('thn_terbit') is-invalid @enderror" name="thn_terbit"
                            placeholder="Tahun Terbit" value="{{ $item->thn_terbit }}">
                        @error('thn_terbit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <select id="penerbit" name="penerbit_id" class="form-control" required>
                            <option value="">Pilih Penerbit</option>
                            @foreach ($items2 as $penerbit)
                            <option value="{{ $penerbit-> id }}" 
                                @if ($penerbit-> id === $item->penerbit_id)
                                    selected
                                @endif                
                                >
                                {{ $penerbit-> namaPenerbit }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover Buku</label>
                        <img src="{{ asset('storage/images/scan-cover-buku/'. $item-> scan) }}" class="img-thumbnail">
                        <input id="cover" type="file" class="form-control-file @error('scan') is-invalid @enderror mt-3" name="scan">
                        @error('scan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Ubah Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
