@extends('layouts.dashboard')

@section('title')
<title>Admin | Edit Pengadaan</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-pengadaan.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-3">Ubah Data Pengadaan Buku</h1>
        </div>

        <div class="card-show">
            <div class="card-body">
                <form action="{{ route('data-pengadaan.update', $item->idPengadaan) }}" method="POST" class="form"
                    id="form">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-2">
                            <label for="buku">Buku</label>
                        </div>
                        <div class="col-6">
                            <select id="buku" name="buku_id" required style="width:500px">
                                <option value="">Pilih Buku</option>
                                @foreach ($bukus as $buku)
                                <option value="{{ $buku->idBuku }}" @if ($item->buku_id == $buku->idBuku)
                                    selected
                                    @endif>{{ $buku->idBuku }}</option>
                                @endforeach
                            </select>
                            @error('buku_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-2">
                            <p class="text-dark text-bold">Judul Buku</p>
                            <p class="text-dark text-bold">Pengarang</p>
                            <p class="text-dark text-bold">Penerbit</p>
                        </div>
                        <div class="col-4">
                            <p id="judul" class="text-dark">{{ $item->buku->judul }}</p>
                            <p id="pengarang" class="text-dark">{{ $item->buku->pengarang }}</p>
                            <p id="penerbit" class="text-dark">{{ $item->buku->penerbit->namaPenerbit }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="asal_buku">Asal Buku</label>
                        <input id="asal_buku" type="text" class="form-control @error('asal_buku') is-invalid @enderror"
                            name="asal_buku" placeholder="Asal Buku" value="{{ $item->asal_buku }}">
                        @error('asal_buku')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jml_masuk">Jumlah Masuk</label>
                        <input id="jml_masuk" type="number" class="form-control @error('jml_masuk') is-invalid @enderror"
                            name="jml_masuk" placeholder="Jumlah Masuk" value="{{ $item->jml_masuk }}">
                        @error('jml_masuk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Masuk</label>
                        <input id="tanggal" type="text" class="date form-control @error('tanggal') is-invalid @enderror"
                            name="tanggal" autocomplete="off" value="{{ $item->tanggal }}">
                        @error('tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input id="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" placeholder="Keterangan" value="{{ $item->keterangan }}">
                        @error('keterangan')
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
<script type="text/javascript">
    $('#buku').select2({
        placeholder: 'Pilih ID Buku',
        tags: true
    });

    $(document).on('change', '#buku', function (e) {
        var id = $(this).val();
        e.preventDefault();
        $.ajax({
            url: `{{ route('data-peminjaman.show', false) }}/${id}`,
            type: 'get',
            delay: 100,
            dataType: 'json',
            success: function (response) {
                if (response != null) {
                    document.getElementById('judul').innerHTML = response.judul;
                    document.getElementById('pengarang').innerHTML = response.pengarang;
                    document.getElementById('penerbit').innerHTML = response.penerbit.namaPenerbit;
                }
            }
        });
    });

</script>

@if (Session::get('error-ubah'))
<script>
    swal("Gagal", "Data Pengadaan Buku Sudah Tersedia", "error");

</script>
@endif

@if ($errors->count() > 0)
<script>
    swal("Gagal", "Data Belum Valid", "error");
</script>
@endif

  <script>
      $('.update-confirm').click(function (event) {
          var form = $(this).closest("form");
          var value = $('#asal_buku').val();
          var value2 = $('#jml_masuk').val();
          var value3 = $('#tanggal').val();
          var value4 = $('#keterangan').val();
          if (!value || !value2 || !value3 || !value4 ) {
            swal("Gagal", "Masih Terdapat Field Yang Kosong", "error");
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

      $("document").ready(function () {
          $('#asal_buku, #jumlah, #tanggal, #keterangan').on("keyup focusout", function () {
              var value = $(this).val();
              if (!value) {
                  toastr.warning('Error', 'Field Tidak Boleh Kosong');
                  $(this).addClass('is-invalid');
              } else {
                  $(this).removeClass('is-invalid');
              }
          });
      });

  </script>

<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
<script type="text/javascript">
    $('.date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        clearBtn: true
    });

</script>
@endpush
