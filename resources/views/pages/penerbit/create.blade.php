@extends('layouts.dashboard')

@section('title')
    <title>Admin | Tambah Penerbit</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-penerbit.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-2">Tambah Data Penerbit</h1>
        </div>

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
        swal("Gagal", "Nama Penerbit Sudah Terdaftar", "error");
    </script>
    @endif

    @if ($errors->count() > 0)
        <script>
            swal("Gagal", "Data Belum Valid", "error");
        </script>
    @endif

    <script>
        $('.create-confirm').click(function(event) {
            var form =  $(this).closest("form");
            var value = $('#namaPenerbit').val();
            if(!value) {
                swal("Gagal", "Field Nama Penerbit Tidak Boleh Kosong", "error");
                return false;
            }else {
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

        $("document").ready(function(){
            $('#namaPenerbit').on("keyup focusout", function () {
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