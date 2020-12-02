@extends('layouts.dashboard')

@section('title')
    <title>Admin | Edit Kategori</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-kategori.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-2">Ubah Data Kategori</h1>
        </div>

        <div class="card-show">
                <div class="card-body">
                    <form action="{{ route('data-kategori.update', $item->id) }}" method="POST" class="form" id="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="namaKategori">Nama Kategori</label>
                            <input id="namaKategori" type="text" class="form-control @error('namaKategori') is-invalid @enderror" name="namaKategori" placeholder="Nama Kategori" value="{{ $item->namaKategori }}">
                            @error('namaKategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block update-confirm">
                            Ubah Data
                        </button>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection

@push('addon-script')
@if (Session::get('error-ubah'))
    <script>
        swal("Gagal", "No Identitas Sudah Terdaftar", "error");
    </script>
    @endif

    @if ($errors->count() > 0)
        <script>
            swal("Gagal", "Data Belum Valid", "error");
        </script>
    @endif

    <script>
        $('.update-confirm').click(function(event) {
            var form =  $(this).closest("form");
            var value = $('#namaKategori').val();
            if(!value) {
                swal("Gagal", "Field Nama Kategori Tidak Boleh Kosong", "error");
                return false;
            }else {
                event.preventDefault();
                swal({
                    title: `Ubah Data?`,
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

        $("document").ready(function(){
            $('#namaKategori').on("keyup bind cut copy paste focusout", function () {
                var value = $(this).val();
                if(!value){
                    toastr.warning('Error','Field Tidak Boleh Kosong');
                    $(this).addClass('is-invalid');
                }else{
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush