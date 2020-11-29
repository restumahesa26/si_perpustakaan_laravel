@extends('layouts.dashboard')

@section('title')
    <title>Admin | Data Peminjaman</title>
@endsection

@section('content')
<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Peminjaman</h1>
                    <form class="form-inline" action="{{ route('search-peminjaman') }}">
                        <a href="{{ route('riwayat-peminjaman') }}" class="btn btn-danger mr-2 mt-3" id="clear">Bersihkan</a>
                        <input class="form-control mr-2 mt-3" type="search" placeholder="Kata kunci" aria-label="Search" id="search" name="search" autocomplete="off">
                        <button class="btn btn-outline-success mt-3" type="submit">Cari</button>
                    </form>
                </div>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>No</th>
                                    <th>ID Anggota</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Perpanjang</th>
                                    <th>Tgl Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
                                    <td>{{ $item->pengunjung_id }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') }}</td>
                                    <td class="text-center">@if ($item->tgl_panjang == NULL)
                                            -
                                        @else
                                        {{ Carbon\Carbon::parse($item->tgl_panjang)->format('d-m-Y') }}
                                        @endif
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($item->tgl_kembali)->format('d-m-Y') }}</td>
                                    <td>
                                        @if ( $item->status == "Perpanjang" )
                                            <p class="badge badge-warning">{{ $item->status}}</p>
                                        @endif
                                        @if ( $item->status == "Pinjam" )
                                            <p class="badge badge-primary">{{ $item->status}}</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('riwayat-peminjaman.show', $item->idPeminjaman) }}" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Tidak Ada Riwayat Peminjaman
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
