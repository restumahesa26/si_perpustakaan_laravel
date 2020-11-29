@extends('layouts.dashboard')

@section('title')
    <title>Admin | Perpanjang</title>
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-peminjaman.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-2">Perpanjang Peminjaman</h1>
        </div>

        @if ($errors->count() > 0)
        @php
        Alert::error('Gagal Mengubah Data', 'Masih Terdapat Data Belum Valid');
        @endphp
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-peminjaman.perpanjang', $item->idPeminjaman) }}" method="POST" class="form" id="form">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-2">
                        <label>Nama</label>
                    </div>
                    <div class="col-4">
                        {{ $item->pengunjung->nama }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2">
                        <label id="dd">Tanggal Pinjam</label>
                    </div>
                    <div class="col-4">
                        {{ Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2">
                        <label id="dd">Tanggal Perpanjang</label>
                    </div>
                    <div class="col-4">
                        @if ($item->tgl_panjang == NULL)
                        Belum Pernah Perpanjang Buku
                        @else
                        {{ Carbon\Carbon::parse($item->tgl_panjang)->format('d-m-Y') }}
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2">
                        <label>Tanggal Kembali</label>
                    </div>
                    <div class="col-4">
                        {{ Carbon\Carbon::parse($item->tgl_kembali)->format('d-m-Y') }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2">
                        <label>Masukkan Tanggal</label>
                    </div>
                    <div class="col-4">
                        <input type="date" name="tgl_pinjam" class="form-control" id="tgl_pinjam">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2">
                        <label class="text-danger">Denda</label>
                    </div>
                    <div class="col-4">
                        <h4 id="denda" class="text-danger"></h4>
                    </div>
                </div>
                <div class="table-responsive text-center">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Judul</td>
                                <td>ISBN</td>
                                <td>Pengarang</td>
                                <td>Penerbit</td>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($item->buku as $buku)
                            <tr>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->isbn }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ $buku->penerbit->namaPenerbit }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @error('buku_id.*')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" placeholder="Keterangan">{{ $item->keterangan }}
                        </textarea>
                    @error('keterangan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Perpanjang Peminjaman
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    $(document).on('change', '#tgl_pinjam', function (e) {
        var id = $('#id-peminjaman').val();
        var tgl_pinjam = $('#tgl_pinjam').val();
        e.preventDefault();
        $.ajax({
            url: `{{ route('data-peminjaman.denda', $item->idPeminjaman) }}`,
            data: {
                'tgl_pinjam': tgl_pinjam
            },
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response != null) {
                    if(response == 'Rp. 0,-') {
                        document.getElementById("denda").innerHTML = 'Tidak Ada Denda';
                    }else {
                        document.getElementById("denda").innerHTML = response;
                    }
                }
            }
        });
    });
</script>
@endpush
