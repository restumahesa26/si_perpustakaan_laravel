@extends('layouts.dashboard')

@section('title')
    <title>Admin | Peminjaman</title>
@endsection

@section('content')
<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Sirkulasi</h1>
                    <a href="{{ route('data-peminjaman.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Peminjaman
                    </a>
                </div>

                <div class="d-sm-flex justify-content-end">
                    <form class="form-inline" action="{{ route('search-sirkulasi') }}">
                        <a href="{{ route('data-peminjaman.index') }}" class="btn btn-danger mr-2 mt-1" id="clear">Bersihkan</a>
                        <input class="form-control mr-2 mt-1" type="search" placeholder="Kata kunci ( * )" aria-label="Search" id="search" name="search" autocomplete="off">
                        <button class="btn btn-outline-success mt-1" type="submit">Cari</button>
                    </form>
                </div>

                <div class="d-sm-flex justify-content-end mb-4">
                    <span class="text-blue">* id anggota</span>
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
                                            <button class="btn btn-outline-danger delete-confirm" data-toggle="tooltip" data-placement="bottom"
                                                title="Hapus Data" data-name="{{ $item->pengunjung_id }}">
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

@push('addon-script')

<script>
    $('.delete-confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Hapus Data ${name}?`,
            text: "Data akan terhapus secara permanen",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>

@if (Session::get('success-hapus'))
    <script>
        swal("Berhasil Menghapus Data", "Data Peminjaman Sudah Terhapus Secara Permanen", "success");
    </script>
@endif

@if (Session::get('success-tambah'))
    <script>
        swal("Berhasil", "Data Peminjaman Berhasil Ditambah", "success");
    </script>
@endif

@if (Session::get('success-perpanjang'))
    <script>
        swal("Berhasil", "Data Peminjaman Berhasil Diperpanjang", "success");
    </script>
@endif

@if (Session::get('success-pengembalian'))
    <script>
        swal("Berhasil", "Data Peminjaman Berhasil Dikembalikan", "success");
    </script>
@endif

@endpush