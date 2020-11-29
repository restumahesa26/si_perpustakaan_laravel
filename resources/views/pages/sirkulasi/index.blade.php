@extends('layouts.dashboard')

@section('title')
    <title>Admin | Peminjaman</title>
@endsection

@section('content')
<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Sirkulasi</h1>
                    <a href="{{ route('data-peminjaman.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Peminjaman
                    </a>
                </div>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>No</th>
                                    <th>Nama</th>
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
                                    <td>{{ $item->pengunjung->nama }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') }}
                                    </td>
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
                                        <div class="row py-1 justify-content-center">
                                            <a href="{{ route('data-peminjaman.edit', $item->idPeminjaman) }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top"
                                                title="Edit Data">
                                                Perpanjang
                                            </a>
                                        </div>
                                        <div class="row py-1 justify-content-center">
                                        <a href="{{ route('data-peminjaman.kembali', $item->idPeminjaman) }}" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top"
                                            title="Edit Data">
                                            Kembalikan
                                        </a>
                                        </div>
                                        <div class="row py-1 justify-content-center">
                                        <form action="{{ route('data-peminjaman.destroy', $item->idPeminjaman) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-outline-danger" data-toggle="tooltip" data-placement="bottom"
                                                title="Hapus Data">
                                                Hapus
                                            </button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Tidak Ada Transaksi Peminjaman
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
