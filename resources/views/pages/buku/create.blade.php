@extends('layouts.dashboard')

@section('title')
<title>Admin | Tambah Buku</title>
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-buku.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-2">Tambah Data Buku</h1>
        </div>

        <div class="card-show">
            <div class="card-body">
                <form action="{{ route('data-buku.store') }}" method="POST" class="form" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror"
                                    name="judul" placeholder="Judul" value="{{ old('judul') }}">
                                @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" name="kategori_id" class="form-control" required>
                                    <option value="null">Pilih Kategori</option>
                                    @foreach ($items as $kategori)
                                    <option value="{{ $kategori-> id }}" @if (old('kategori_id')==$kategori->id)
                                        selected @endif >
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
                                    name="isbn" placeholder="ISBN" value="{{ old('isbn') }}">
                                @error('isbn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pengarang">Pengarang</label>
                                <input id="pengarang" type="text"
                                    class="form-control @error('pengarang') is-invalid @enderror" name="pengarang"
                                    placeholder="Pengarang" value="{{ old('pengarang') }}">
                                @error('pengarang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="halaman">Halaman</label>
                                <input id="halaman" type="number"
                                    class="form-control @error('halaman') is-invalid @enderror" name="halaman"
                                    placeholder="Halaman" value="{{ old('halaman') }}">
                                @error('halaman')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror"
                                    name="stok" placeholder="Stok" value="{{ old('stok', "0") }}">
                                @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="thn_terbit">Tahun Terbit</label>
                                <input id="thn_terbit" type="number"
                                    class="form-control @error('thn_terbit') is-invalid @enderror" name="thn_terbit"
                                    placeholder="Tahun Terbit" value="{{ old('thn_terbit') }}">
                                @error('thn_terbit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="penerbit">Penerbit</label> 
                                <select id="penerbit" name="penerbit_id" class="form-control" required>
                                    <option value="null">Pilih Penerbit</option>
                                    @foreach ($items2 as $penerbit)
                                    <option value="{{ $penerbit-> id }}" @if (old('penerbit_id')==$penerbit->id)
                                        selected @endif >
                                        {{ $penerbit-> namaPenerbit }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cover">Cover Buku</label>
                                <img id="image" style="max-width:350px;">
                                <input id="cover" type="file"
                                    class="form-control-file @error('scan') is-invalid @enderror" name="scan" required
                                    onchange="preview_image(event)">
                                @error('scan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block create-confirm">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')

@if (Session::get('error-tambah'))
<script>
    swal("Gagal", "Judul Buku Sudah Terdaftar", "error");

</script>
@endif

@if ($errors->count() > 0)
<script>
    swal("Gagal", "Data Belum Valid", "error");

</script>
@endif

<script>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    $('.create-confirm').click(function (event) {
        var form = $(this).closest("form");
        var value = $('#judul').val();
        var value2 = $('#isbn').val();
        var value3 = $('#pengarang').val();
        var value4 = $('#halaman').val();
        var value5 = $('#stok').val();
        var value6 = $('#thn_terbit').val();
        var value7 = $('#kategori').val();
        var value8 = $('#penerbit').val();
        if (!value || !value2 || !value3 || !value4 || !value5 || !value6 || value7 == 'null' || value8 == 'null') {
            swal("Gagal", "Masih Terdapat Field Yang Kosong", "error");
            return false;
        } else {
            event.preventDefault();
            swal({
                    title: `Tambah Data?`,
                    text: "Pastikan data sudah diisi dengan benar",
                    icon: "info",
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        }
    });

    $("document").ready(function () {
        $('#judul, #isbn, #pengarang, #halaman, #stok, #thn_terbit').on("keyup bind cut copy paste focusout",
            function () {
                var value = $(this).val();
                if (!value) {
                    toastr.warning('Error', 'Field Tidak Boleh Kosong');
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        $('#kategori, #penerbit').on("change focusout", function () {
            var value = $(this).val();
            if (value == 'null') {
                toastr.warning('Error', 'Pilih Terlebih Dahulu');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
    });

</script>
@endpush
