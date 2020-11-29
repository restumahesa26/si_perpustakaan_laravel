@extends('layouts.dashboard')

@section('title')
    <title>Admin | Laporan Pengguna</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Anggota</h1>
                </div>

                <form action="{{ route('printPengunjung') }}" class="d-sm-flex align-items-center justify-content-start mb-4">
                    @csrf
                    <button class="btn btn-outline-success" type="submit">Cetak Laporan</button>
                </form>
            
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-gradient-gray">
                                    <th>ID Anggota</th>
                                    <th>Nama</th>
                                    <th>Nomor Identitas</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">            
                                @forelse ($items as $item)
                                <tr class="text-center">
                                    <td class="bg-gradient-gray">{{ $item->idPengunjung }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->no_idt }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->alamat }}</td>
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
