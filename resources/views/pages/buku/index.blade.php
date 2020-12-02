@extends('layouts.dashboard')

@section('title')
    <title>Admin | Buku</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-0">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Buku</h1>
                    <a href="{{ route('data-buku.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Buku
                    </a>
                </div>

                <div class="d-sm-flex justify-content-end">
                    <form class="form-inline" action="{{ route('search-buku') }}">
                        <a href="{{ route('data-buku.index') }}" class="btn btn-danger mr-2 mt-1" id="clear">Bersihkan</a>
                        <input class="form-control mr-2 mt-1" type="search" placeholder="Kata kunci ( * )" aria-label="Search" id="search" name="search" autocomplete="off">
                        <button class="btn btn-outline-success mt-1" type="submit">Cari</button>
                    </form>
                </div>

                <div class="d-sm-flex justify-content-end mb-4">
                    <span class="text-blue">* id buku, judul, kategori, pengarang, tahun terbit, penerbit</span>
                </div>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>ID Buku</th>
                                    <th>Judul</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">            
                                @forelse ($items as $item)
                                <tr class="text-center">
                                    <td class="bg-gradient-gray">{{ $item->idBuku }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->kategori->namaKategori }}</td>
                                    <td>{{ $item->pengarang }}</td>
                                    <td>{{ $item->penerbit->namaPenerbit }}</td>
                                    <td>
                                        <a href="{{ route('data-buku.edit', $item->idBuku) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                            title="Edit Data">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('data-buku.destroy', $item->idBuku) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger delete-confirm" data-toggle="tooltip" data-placement="bottom"
                                                title="Hapus Data" data-name="{{ $item->idBuku }}">
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

@if (Session::get('error-hapus'))
    <script>
        swal("Gagal Menghapus Data", "Buku Sudah Tersedia dan Dipinjam", "error");
    </script>
@endif

@if (Session::get('success-hapus'))
    <script>
        swal("Berhasil Menghapus Data", "Data Buku Sudah Terhapus Secara Permanen", "success");
    </script>
@endif

@if (Session::get('success-tambah'))
    <script>
        swal("Berhasil", "Data Pengunjung Berhasil Ditambah", "success");
    </script>
@endif

@if (Session::get('success-ubah'))
    <script>
        swal("Berhasil", "Data Pengunjung Berhasil Diubah", "success");
    </script>
@endif

@endpush