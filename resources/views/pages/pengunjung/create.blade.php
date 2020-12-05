@extends('layouts.dashboard')

@section('title')
    <title>Admin | Tambah Anggota</title>
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-pengunjung.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-2">Tambah Data Anggota</h1>
        </div>
        
        <div class="card-show">
                <div class="card-body">
                    <form action="{{ route('data-pengunjung.store') }}" method="POST" class="form" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password <sup>* min 8</sup></label>
                            <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_idt">Nomor Identitas <sup>* KTP, KTM, KTS, dll</sup> </label>
                            <input id="no_idt" type="text" class="form-control @error('no_idt') is-invalid @enderror" name="no_idt" placeholder="Nomor Identitas" value="{{ old('no_idt') }}">
                            @error('no_idt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select id="jk" name="jk" class="form-control" required>
                                <option value="null">Pilih</option>
                                <option value="l" @if ( old('jk') == 'l' )
                                    selected
                                @endif >Laki-Laki</option>
                                <option value="p" @if ( old('jk') == 'p' )
                                    selected
                                @endif >Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone <sup>* No.WA / No.Telepon</sup> </label>
                            <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="No Telepon" value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                            @error('alamat')
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
        swal("Gagal", "No Identitas Sudah Terdaftar", "error");
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
            var value = $('#nama').val();
            var value2 = $('#password').val();
            var value3 = $('#no_idt').val();
            var value4 = $('#no_hp').val();
            var value5 = $('#alamat').val();
            var value6 = $('#jk').val();
            if(!value || !value2 || !value3 || !value4 || !value5 || value6 == 'null') {
                swal("Gagal", "Masih Terdapat Field Yang Kosong", "error");
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
            $('#nama, #password, #no_idt, #no_hp, #alamat').on("keyup focusout", function () {
                var value = $(this).val();
                if(!value){
                    toastr.warning('Error','Field Tidak Boleh Kosong');
                    $(this).addClass('is-invalid');
                }else{
                    $(this).removeClass('is-invalid');
                }
            });
            $('#jk').on("change focusout", function() {
                var value = $(this).val();
                if(value == 'null'){
                    toastr.warning('Error','Pilih Jenis Kelamin');
                    $(this).addClass('is-invalid');
                }else{
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush