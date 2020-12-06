@extends('layouts.home')

@section('title')
    <title>Home | Absen Kunjungan</title>
@endsection

@section('content')
    <main>
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-8 d-none d-md-block">
                    <img src="{{ url('frontend/images/ilustrasi-2.png') }}" alt="" class="img-illustration-2">
                </div>
                <div class="col-md-4 login-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('absen') }}">
                                @csrf
                                <div class="text-center mb-3 login-text">
                                    <h5>Isi Daftar Kunjungan</h5>
                                </div>
                                <div class="form-group">
                                    <label for="pengunjung_id" class="col-form-label">ID Anggota : </label>
                                    <input type="text" class="form-control" id="pengunjung_id" name="pengunjung_id" value="{{ old('pengunjung_id') }}">
                                    <h5 class="text-danger" id="info"></h5>
                                </div>
                                <div class="form-group=">
                                    <label for="pass" class="col-form-label">Password : </label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="tujuan" class="col-form-label">Tujuan : </label>
                                    <select id="tujuan" class="form-control" name="tujuan">
                                        <option value="pinjam">Meminjam Buku</option>
                                        <option value="kembali">Mengembalikan Buku</option>
                                        <option value="baca">Membaca Buku</option>
                                        <option value="rekreasi">Rekreasi</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-daftar create-confirm">
                                    Isi Absen
                                </button>
                                <a class="btn btn-link" href="{{ route('daftar') }}">
                                    Belum Jadi Anggota?
                                </a>
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
  $(document).on('keyup change paste focusout', '#pengunjung_id', function (e) {
      var id = $('#pengunjung_id').val();
      e.preventDefault();
      $.ajax({
          url: `{{ route('api-cek-id-anggota') }}`,
          data: {
              'id_anggota': id
          },
          type: 'get',
          dataType: 'json',
          success: function (response) {
              if (response == 'gagal') {
                document.getElementById('pengunjung_id').classList.add('is-invalid');
                document.getElementById("info").innerHTML = "ID Belum Terdaftar";
              }
              if (response == 'berhasil') {
                document.getElementById('pengunjung_id').classList.remove('is-invalid');
                document.getElementById("info").innerHTML = null;
              }
          }
      });
  });
</script>

    @if (Session::get('success-daftar'))
        <script>
            swal("Berhasil Daftar Anggota", "Silakan ke Bagian Staf untuk Pembuatan Kartu", "success");
        </script>
    @endif

    @if (Session::get('error-absen-1'))
        <script>
            swal("Gagal Absen", "Hanya Boleh Maksimal 1x Absen", "error");
        </script>
    @endif

    @if (Session::get('error-absen-2'))
        <script>
            swal("Gagal Absen", "ID Anggota dan Password Tidak Cocok", "error");
        </script>
    @endif

    <script>
      $('.create-confirm').click(function(event) {
          var form =  $(this).closest("form");
          var value = $('#pengunjung_id').val();
          var value2 = $('#password').val();
          if( !value || !value2 ) {
              swal("Gagal", "Masih Terdapat Field Yang Kosong", "error");
              return false;
          }else {
              event.preventDefault();
              swal({
                  title: `Isi Absen Kunjungan?`,
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
          $('#pengunjung_id, #password').on("keyup focusout", function () {
              var value = $(this).val();
              if(value.length === 0){
                  toastr.warning('Field Tidak Boleh Kosong');
                  $(this).addClass('is-invalid');
              }else{
                  $(this).removeClass('is-invalid');
              }
          });
      });
  </script>
@endpush