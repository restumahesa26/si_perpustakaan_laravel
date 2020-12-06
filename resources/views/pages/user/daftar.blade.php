@extends('layouts.home')

@section('title')
    <title>Home | Daftar Anggota</title>
@endsection

@section('content')
    <main>
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-6 d-none d-md-block">
                    <img src="{{ url('frontend/images/ilustrasi-3.png') }}" alt="" class="img-illustration-3">
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('daftar-anggota') }}" class="form">
                                @csrf
                                @method('GET')
                                <div class="text-center mb-3 login-text">
                                    <h5>Daftar sebagai Anggota</h5>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group=">
                                    <label for="no_idt" class="col-form-label">Nomor Identitas <sup>* KTP, KTM, KTS, dll</sup></label>
                                    <input id="no_idt" type="text" class="form-control @error('no_idt') is-invalid @enderror" name="no_idt" placeholder="Nomor Identitas" value="{{ old('no_idt') }}">
                                    <h5 class="text-danger" id="info"></h5>
                                    @error('no_idt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password <sup>* min 8</sup></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jk" class="col-form-label">Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="form-control">
                                        <option value="null">Pilih</option>
                                        <option value="l" @if ( old('jk') == 'l' )
                                            selected
                                        @endif >Laki-Laki</option>
                                        <option value="p" @if ( old('jk') == 'p' )
                                            selected
                                        @endif >Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group=">
                                    <label for="no_hp" class="col-form-label">No Handphone <sup>* No.WA / No.Telepon</sup> </label>
                                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="No Telepon" value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="col-form-label">Alamat</label>
                                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-daftar create-confirm">
                                    Daftar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('addon-script')
<script>
  $(document).on('keyup change paste', '#no_idt', function (e) {
      var no_idt = $('#no_idt').val();
      e.preventDefault();
      $.ajax({
          url: `{{ route('api-cek-no_idt') }}`,
          data: {
              'no_idt': no_idt
          },
          type: 'get',
          dataType: 'json',
          success: function (response) {
              if (response == 'gagal') {
                document.getElementById('no_idt').classList.add('is-invalid');
                document.getElementById("info").innerHTML = "No Identitas Sudah Terpakai";
              }
              if (response == 'berhasil') {
                document.getElementById('no_idt').classList.remove('is-invalid');
                document.getElementById("info").innerHTML = null;
              }
          }
      });
  });
</script>
    @if (Session::get('error-daftar'))
        <script>
            swal("Gagal Daftar", "No Identitas Sudah Digunakan Sebelumnya", "error");
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