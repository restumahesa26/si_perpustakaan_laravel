@extends('layouts.dashboard')

@section('title')
    <title>Admin | Tambah Penerbit</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('data-penerbit.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black mt-2">Tambah Data Penerbit</h1>
        </div>

        @if ($errors->count() > 0)
            @php
            Alert::error('Gagal Mengubah Data', 'Masih Terdapat Data Belum Valid');
            @endphp
        @endif

        <div class="card-show">
                <div class="card-body">
                    <form action="{{ route('data-penerbit.store') }}" method="POST" class="form" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="namaPenerbit">Penerbit</label>
                            <input id="namaPenerbit" type="text" class="form-control @error('namaPenerbit') is-invalid @enderror" name="namaPenerbit" placeholder="Nama Penerbit" value="{{ old('namaPenerbit') }}">
                            @error('namaPenerbit')
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
