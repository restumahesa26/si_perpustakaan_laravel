@extends('layouts.dashboard')

@section('title')
    <title>Admin | Tambah Peminjaman</title>
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center mb-4">
            <a href="{{ route('data-peminjaman.index') }}" class="btn btn-sm btn-warning shadow-sm mb-0 mt-2">
                <i class="fas fa-arrow-left fa-sm"></i> Back
            </a>
            <h1 class="h3 mb-0 mt-2 text-black ml-2">Tambah Data Peminjaman</h1>
        </div>

        <h1 class="text-danger" id="info"></h1>

        <form action="{{ route('data-peminjaman.store') }}" method="POST" class="form" id="form">
            @csrf
            <div class="card">
                <div class="card-title ml-2 mt-2">
                  <h4>Data Peminjam</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-2">
                            <label for="pengunjung_id">ID Anggota</label>
                        </div>
                        <div class="col-4">
                            <select id="pengunjung_id" name="pengunjung_id" class="form-control" required="required">
                                <option value="null" selected="selected"  >Pilih ID Anggota</option>
                                @foreach ($pengunjungs as $pengunjung)
                                <option value="{{ $pengunjung->idPengunjung }}" @if ( old('pengunjung_id') == $pengunjung->idPengunjung )
                                        selected
                                    @endif>
                                    {{ $pengunjung->idPengunjung }}
                                </option>
                                @endforeach
                            </select>
                            @error('pengunjung_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-2">
                            <label>Nama</label>
                        </div>
                        <div class="col-4">
                            <p id="nama">-</p>
                        </div>
                        <div class="col-2">
                            <label>No Telepon</label>
                        </div>
                        <div class="col-4">
                            <p id="no_telepon">-</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-2">
                            <label>Tanggal Pinjam</label>
                        </div>
                        <div class="col-4">
                            <label>{{ Carbon\Carbon::now()->format('d-m-Y') }}</label>
                        </div>
                        <div class="col-2">
                            <label>Tanggal Kembali</label>
                        </div>
                        <div class="col-4">
                          <label>{{ Carbon\Carbon::now()->addDays(7)->format('d-m-Y') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-title ml-2 mt-2">
                  <h4>Data Buku</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Judul</td>
                                    <td>ISBN</td>
                                    <td>Pengarang</td>
                                    <td>Penerbit</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>
                                        <select id="buku_id" name="buku_id[]" required="required" class="form-control buku" style="width:350px;">
                                            <option value="null" selected="selected">Pilih Buku</option>
                                            @foreach ($bukus as $buku)
                                            <option value="{{ $buku->idBuku }}">{{ $buku->judul }}</option>
                                            @endforeach
                                        </select>
                                        @error('buku_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror 
                                    </td>
                                    <td id="isbn"></td>
                                    <td id="pengarang"></td>
                                    <td id="penerbit"></td>
                                    <td>
                                        <button type="button" class="btn btn-info" id="addBtn">Tambah</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @error('buku_id.*')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input id="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}">
                        @error('keterangan')
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
@endsection

@push('addon-script')
<script>
    $(document).ready(function () {
        // Denotes total number of rows 
        var rowIdx = 0;

        // jQuery button click event to add a row 
        $('#addBtn').on('click', function () {
            // Adding a row inside the tbody. 
            $('#tbody').append(`<tr>
                <td>
                    <select id="buku_id`+ ++rowIdx +`" name="buku_id[]" class="form-control buku" required style="width:350px;">
                        <option value="null">Pilih Buku</option>
                        @foreach ($bukus as $buku)
                        <option value="{{ $buku->idBuku }}">{{ $buku->judul }}</option>
                        @endforeach
                    </select> 
                    </td>
                    <td id="isbn`+ rowIdx +`"></td>
                    <td id="pengarang`+ rowIdx +`"></td>
                    <td id="penerbit`+ rowIdx +`"></td>
                    <td>
                        <button class="btn btn-danger remove"
                            type="button">Remove</button> 
                    </td>
                </tr>`);

                $('#buku_id'+ rowIdx +'').select2();

                $(document).on('change', '#buku_id'+ rowIdx +'', function (e) {
                    var id = $(this).val();
                    e.preventDefault();
                    $.ajax({
                        url: `{{ route('data-peminjaman.show', false) }}/${id}`,
                        type: 'get',
                        dataType: 'json',
                        success: function (response) {
                            if (response != null) {
                                document.getElementById('isbn'+ rowIdx +'').innerHTML = response.isbn;
                                document.getElementById('pengarang'+ rowIdx +'').innerHTML = response.pengarang;
                                document.getElementById('penerbit'+ rowIdx +'').innerHTML = response.penerbit.namaPenerbit;
                            }
                        }
                    });
                });

                $('#buku_id'+ rowIdx +'').on("change focusout selected", function () {
                  var value = $(this).val();
                  if (value == 'null') {
                      toastr.warning('Error', 'Pilih Terlebih Dahulu');
                      $(this).addClass('is-invalid');
                      document.getElementById('isbn'+ rowIdx +'').innerHTML = null;
                      document.getElementById('pengarang'+ rowIdx +'').innerHTML = null;
                      document.getElementById('penerbit'+ rowIdx +'').innerHTML = null;
                  } else {
                      $(this).removeClass('is-invalid');
                  }
                });

            });

        // jQuery button click event to remove a row. 
        $('#tbody').on('click', '.remove', function () {

            // Getting all the rows next to the row 
            // containing the clicked button 
            var child = $(this).closest('tr').nextAll();

            // Iterating across all the rows  
            // obtained to change the index 
            child.each(function () {

                // Getting <tr> id. 
                var id = $(this).attr('id');

                // Getting the <p> inside the .row-index class. 
                var idx = $(this).children('.row-index').children('p');

                // Gets the row number from <tr> id. 
                var dig = parseInt(id.substring(1));

                // Modifying row index. 
                idx.html(`Row ${dig - 1}`);

                // Modifying row id. 
                $(this).attr('id', `R${dig - 1}`);
            });

            // Removing the current row. 
            $(this).closest('tr').remove();

            // Decreasing total number of rows by 1. 
            rowIdx--;
        });

    $(document).ready(function(){
        $(document).on('change', '#buku_id', function (e) {
            var id = $(this).val();
            e.preventDefault();
            $.ajax({
                url: `{{ route('data-peminjaman.show', false) }}/${id}`,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response != null) {
                        document.getElementById('isbn').innerHTML = response.isbn;
                        document.getElementById('pengarang').innerHTML = response.pengarang;
                        document.getElementById('penerbit').innerHTML = response.penerbit.namaPenerbit;
                    }
                }
            });
        });
    });

    $('#pengunjung_id').select2();

    $('#buku_id').select2();
});
$(document).on('change', '#pengunjung_id', function (e) {
    var id = $(this).val();
    e.preventDefault();
    $.ajax({
        url: `{{ route('api-anggota', false) }}/${id}`,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response != null) {
                document.getElementById('nama').innerHTML = response.nama;
                document.getElementById('no_telepon').innerHTML = response.no_hp;
            }
        }
    });
});
</script>

    @if (Session::get('error-absen'))
    <script>
        swal("Pengunjung Belum Absen", "Silahkan Absen Terlebih Dahulu", "error");
    </script>
    @endif

    @if (Session::get('error-tambah'))
    <script>
        swal("Gagal", "Peminjaman Maksimal 3x", "error");
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
            var value = $('#keterangan').val();
            var value2 = $('.buku').val();
            var value3 = $('#pengunjung_id').val();
            if (!value || value2 == 'null' || value3 == 'null' ) {
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

        $("document").ready(function(){
            $('#keterangan').on("keyup focusout", function () {
                var value = $(this).val();
                if(!value){
                  toastr.warning('Error', 'Field Tidak Boleh Kosong');
                    $(this).addClass('is-invalid');
                }else{
                    $(this).removeClass('is-invalid');
                }
            });
            $('#buku_id').on("change focusout selected", function () {
              var value = $(this).val();
              if (value == 'null') {
                  toastr.warning('Error', 'Pilih Terlebih Dahulu');
                  $(this).addClass('is-invalid');
                  document.getElementById('isbn').innerHTML = null;
                  document.getElementById('pengarang').innerHTML = null;
                  document.getElementById('penerbit').innerHTML = null;
              } else {
                  $(this).removeClass('is-invalid');
              }
            });
            $('#pengunjung_id').on("change focusout selected", function () {
              var value = $(this).val();
              if (value == 'null') {
                  toastr.warning('Error', 'Pilih Terlebih Dahulu');
                  $(this).addClass('is-invalid');
                  document.getElementById('nama').innerHTML = null;
                  document.getElementById('no_telepon').innerHTML = null;
              } else {
                  $(this).removeClass('is-invalid');
              }
            });
        });
    </script>
@endpush