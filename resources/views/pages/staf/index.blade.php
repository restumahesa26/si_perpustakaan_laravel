@extends('layouts.dashboard')

@section('title')
    <title>Admin | Data Staf</title>
@endsection

@section('content')
<div class="content-wrapper">
        <div class="container-fluid">
            @if (Auth::user()->roles == 'ADMIN')
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 mt-3 text-black">Data Staf / Admin</h1>
            </div>
                <div class="row mx-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
                                    <td>{{ $no }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->roles }}</td>
                                    <td>
                                        <a href="{{ route('staf.edit', $item->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                            title="Edit Data">
                                            Edit
                                        </a>
                                        <form action="{{ route('staf.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger delete-confirm" data-toggle="tooltip" data-placement="bottom"
                                                title="Hapus Data" data-name="{{ $item->name }}">
                                                Hapus
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
            @else
                <h1 class="py-5 px-5 text-danger">STAF TIDAK MEMILIKI AKSES KE HALAMAN INI!!</h1>
            @endif
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
@endpush