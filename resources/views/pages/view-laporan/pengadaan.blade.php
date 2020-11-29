@extends('layouts.dashboard')

@section('title')
    <title>Admin | Laporan Pengadaan</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Pengadaan</h1>
                </div>
                
                <form action="{{ route('printPengadaan') }}" class="d-sm-flex align-items-center justify-content-start mb-4">
                    @csrf
                    <button class="btn btn-outline-success" type="submit">Cetak Laporan</button>
                </form>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>No</th>
                                    <th>Buku</th>
                                    <th>Asal Buku</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Keterangan</th>
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
                                    <td>{{ $item->buku->judul }}</td>
                                    <td>{{ $item->asal_buku }}</td>
                                    <td>{{ $item->jml_masuk }}</td>
                                    <td>{{ $item->keterangan }}</td>
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
