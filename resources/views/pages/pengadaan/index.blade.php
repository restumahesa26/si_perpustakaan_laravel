@extends('layouts.dashboard')

@section('title')
    <title>Admin | Pengadaan</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Pengadaan Buku</h1>
                    <a href="{{ route('data-pengadaan.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Pengadaan Buku
                    </a>
                </div>

                <div class="d-sm-flex justify-content-end">
                    <form class="form-inline" action="{{ route('search-pengadaan') }}">
                        <a href="{{ route('data-pengadaan.index') }}" class="btn btn-danger mr-2 mt-1" id="clear">Bersihkan</a>
                        <input class="form-control mr-2 mt-1" type="search" placeholder="Kata kunci ( * )" aria-label="Search" id="search" name="search" autocomplete="off">
                        <button class="btn btn-outline-success mt-1" type="submit">Cari</button>
                    </form>
                </div>

                <div class="d-sm-flex justify-content-end mb-4">
                    <span class="text-blue">* id buku, judul, asal buku</span>
                </div>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>No</th>
                                    <th>ID Buku</th>
                                    <th>Buku</th>
                                    <th>Asal Buku</th>
                                    <th>Jumlah Masuk</th>
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
                                    <td>{{ $item->buku_id }}</td>
                                    <td>{{ $item->buku->judul }}</td>
                                    <td>{{ $item->asal_buku }}</td>
                                    <td>{{ $item->jml_masuk }}</td>
                                    <td>
                                        <a href="{{ route('data-pengadaan.edit', $item->idPengadaan) }}" class="btn btn-info editData" data-toggle="tooltip" data-placement="top"
                                            title="Edit Data">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('data-pengadaan.destroy', $item->idPengadaan) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger delete-confirm" data-toggle="tooltip" data-placement="bottom"
                                                title="Hapus Data" data-name="{{ $item->buku_id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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
        swal("Berhasil Menghapus Data", "Data Pengadaan Buku Sudah Terhapus Secara Permanen", "success");
    </script>
@endif

@if (Session::get('success-tambah'))
    <script>
        swal("Berhasil", "Data Pengadaan Buku Berhasil Ditambah", "success");
    </script>
@endif

@if (Session::get('success-ubah'))
    <script>
        swal("Berhasil", "Data Pengadaan Buku Berhasil Diubah", "success");
    </script>
@endif

@endpush