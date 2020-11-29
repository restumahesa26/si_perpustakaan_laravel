@extends('layouts.dashboard')

@section('title')
    <title>Admin | Buku</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Buku</h1>
                    <a href="{{ route('data-buku.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Buku
                    </a>
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
                                            <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                                                title="Hapus Data">
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