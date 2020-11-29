@extends('layouts.dashboard')

@section('title')
    <title>Admin | Laporan Pengembalian</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Pengembalian</h1>
                </div>

                <form action="{{ route('printPengembalian2') }}" target="_blank">
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

                <form action="{{ route('printPengembalian') }}" target="_blank" class="d-sm-flex align-items-center justify-content-start mb-4">
                    @csrf
                    <button class="btn btn-outline-success" type="submit">Cetak Semua Laporan</button>
                </form>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Pengembalian</th>
                                    <th>Tgl Kembali</th>
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
                                    <td>{{ $item->pengunjung->nama }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tgl_pengembalian)->format('d-m-Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tgl_kembali)->format('d-m-Y') }}</td>
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
            </div>
</div>
@endsection

@push('addon-script')
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

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
