@extends('layouts.dashboard')

@section('title')
    <title>Admin | Anggota</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Anggota</h1>
                    <a href="{{ route('data-pengunjung.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Anggota
                    </a>
                </div>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>ID Anggota</th>
                                    <th>Nama</th>
                                    <th>Nomor Identitas</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @forelse ($items as $item)
                                <tr class="text-center">
                                    <td class="bg-gradient-gray">{{ $item->idPengunjung }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->no_idt }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>
                                        <a href="{{ route('printCard', $item->idPengunjung) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                            title="Cetak Kartu" target="_blank">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <a href="{{ route('data-pengunjung.edit', $item->idPengunjung) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                            title="Edit Data">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('data-pengunjung.destroy', $item->idPengunjung) }}" method="POST" class="d-inline">
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
