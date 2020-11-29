@extends('layouts.dashboard')

@section('title')
    <title>Admin | Penerbit</title>
@endsection

@section('content')
<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Penerbit</h1>
                    <a href="{{ route('data-penerbit.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Penerbit
                    </a>
                </div>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>No</th>
                                    <th>Nama Penerbit</th>
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
                                    <th class="bg-gradient-gray">{{ $no }}</th>
                                    <td>{{ $item->namaPenerbit }}</td>
                                    <td>
                                        <a href="{{ route('data-penerbit.edit', $item->id) }}" class="btn btn-info editData" data-toggle="tooltip" data-placement="top"
                                            title="Edit Data">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('data-penerbit.destroy', $item->id) }}" method="POST" class="d-inline" id="hapusForm">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger hapusData" data-toggle="tooltip" data-placement="bottom"
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
