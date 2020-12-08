@extends('layouts.dashboard')

@section('title')
    <title>Admin | Absen Kunjungan</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Absen / Kunjungan</h1>
                    <form class="form-inline" action="{{ route('search-absen') }}">
                        <a href="{{ route('viewAbsen') }}" class="btn btn-danger mr-2 mt-3" id="clear">Bersihkan</a>
                        <input class="form-control mr-2 mt-3" type="search" placeholder="Kata kunci" aria-label="Search" id="search" name="search" autocomplete="off">
                        <button class="btn btn-outline-success mt-3" type="submit">Cari</button>
                    </form>
                </div>
                <form action="{{ route('printAbsen2') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tgl1">Tanggal Awal</label>
                            <input class="date form-control" type="text" name="tgl1" id="tgl1" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tgl2">Tanggal Akhir</label>
                            <input class="date form-control" type="text" name="tgl2" id="tgl2" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-outline-success">Cetak Laporan</button>
                        </div>
                    </div>
                </form>
                
                <form action="{{ route('printAbsen') }}" class="d-sm-flex align-items-center justify-content-start mb-4">
                    @csrf
                    <button class="btn btn-outline-success" type="submit">Cetak Semua Laporan</button>
                </form>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>ID Angggota</th>
                                    <th>Tujuan</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">  
                                @php
                                $no = 0;
                                @endphp          
                                @forelse ($items as $item)
                                @php
                                $no++;
                                @endphp
                                <tr class="text-center">
                                    <td class="bg-gradient-gray">{{ $no }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $item->pengunjung_id }}</td>
                                    <td>
                                        @if ( $item->tujuan == "pinjam" )
                                            <p class="badge badge-warning">Meminjam Buku</p>
                                        @endif
                                        @if ( $item->tujuan == "kembali" )
                                            <p class="badge badge-success">Mengembalikan Buku</p>
                                        @endif
                                        @if ( $item->tujuan == "baca" )
                                            <p class="badge badge-primary">Membaca Buku</p>
                                        @endif
                                        @if ( $item->tujuan == "rekreasi" )
                                            <p class="badge badge-info">Rekreasi</p>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Data Kosong
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $items->links() !!}
                </div>
            </div>
</div>

@endsection
@push('addon-script')

    @if (Session::get('error-tanggal'))
      <script>
          swal("Error", "Format Tanggal Salah", "error");
      </script>
    @endif

    @if (Session::get('error-kosong'))
      <script>
          swal("Warning", "Data Tidak Ditemukan Pada Tanggal Tersebut", "warning");
      </script>
    @endif

    @if (Session::get('error-kosong1'))
      <script>
          swal("Warning", "Data Masih Kosong", "warning");
      </script>
    @endif
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript">
    $('.date').datepicker({  
        format: 'yyyy-mm-dd',
        autoclose: true,
        clearBtn: true
    }); 
</script>
@endpush