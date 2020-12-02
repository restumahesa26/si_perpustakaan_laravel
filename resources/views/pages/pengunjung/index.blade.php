@extends('layouts.dashboard')

@section('title')
    <title>Admin | Anggota</title>
@endsection

@section('content')

<div class="content-wrapper">
        <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 mt-3 text-black">Data Anggota</h1>
                    <a href="{{ route('data-pengunjung.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Anggota
                    </a>
                </div>

                <div class="d-sm-flex justify-content-end">
                    <form class="form-inline" action="{{ route('search-pengunjung') }}">
                        <a href="{{ route('data-pengunjung.index') }}" class="btn btn-danger mr-2 mt-1" id="clear">Bersihkan</a>
                        <input class="form-control mr-2 mt-1" type="search" placeholder="Kata kunci ( * )" aria-label="Search" id="search" name="search" autocomplete="off">
                        <button class="btn btn-outline-success mt-1" type="submit">Cari</button>
                    </form>
                </div>

                <div class="d-sm-flex justify-content-end mb-4">
                    <span class="text-blue">* nama, no identitas, no handphone, alamat</span>
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
                                        <form action="{{ route('data-pengunjung.destroy', $item->idPengunjung) }}" method="POST" class="d-inline" id="form">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger delete-confirm" data-toggle="tooltip" data-placement="bottom"
                                                title="Hapus Data" data-name="{{ $item->idPengunjung }}">
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
        swal("Gagal Menghapus Data", "Pengunjung Sudah Pernah Meminjam Buku", "error");
    </script>
@endif

@if (Session::get('success-hapus'))
    <script>
        swal("Berhasil Menghapus Data", "Data Pengunjung Sudah Terhapus Secara Permanen", "success");
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

